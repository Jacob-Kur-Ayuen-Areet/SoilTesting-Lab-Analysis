<?php

namespace App\Services;

use App\Models\FarmerRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAIService
{
    protected string $apiKey;
    /** Primary model endpoint */
    protected string $endpoint;
    /** Fallback model endpoint if primary returns 503 */
    protected string $fallbackEndpoint;

    public function __construct()
    {
        $this->apiKey   = config('services.gemini.api_key', '');
        // gemini-2.5-flash: available model
        $this->endpoint         = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';
        // fallback
        $this->fallbackEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';
    }

    /**
     * Generate a soil analysis interpretation from farmer request.
     */
    public function generateSoilAnalysis(FarmerRequest $request): ?string
    {
        $prompt = $this->buildAnalysisPrompt($request);
        return $this->callGemini($prompt);
    }

    /**
     * Generate crop-specific fertilizer and management recommendations.
     */
    public function generateRecommendation(FarmerRequest $request): ?string
    {
        $prompt = $this->buildRecommendationPrompt($request);
        return $this->callGemini($prompt);
    }

    /**
     * Helper to format FarmerRequest data into a readable text block for LLM.
     */
    protected function formatRequestData(FarmerRequest $request): string
    {
        $farmerName   = $request->farmer->farmer_name ?? 'N/A';
        $farmName     = $request->farm->farm_name ?? 'N/A';
        $dateReceived = $request->date_received ?? 'N/A';
        $receiptNumber = $request->receipt_number ?? 'N/A';
        $email        = $request->email ?? ($request->farmer->email ?? 'N/A');
        $postalAddress = $request->postal_address ?? 'N/A';
        $dateSampled  = $request->date_sampled ?? 'N/A';
        $contactPhone = $request->contact_phone ?? ($request->farmer->contact_phone ?? 'N/A');
        $locality     = $request->ica_locality ?? 'Zimbabwe';
        $numSamples   = $request->number_of_samples ?? 'N/A';
        $avgSubSamples = $request->average_sub_samples_taken ?? 'N/A';
        $earliestColl = $request->earliest_date_of_collection ?? 'N/A';
        $advisorName  = $request->advisor_name ?? 'N/A';

        $dataStr  = "=== FARMER INFORMATION ===\n";
        $dataStr .= "Farmer Name: $farmerName\n";
        $dataStr .= "Farm Name: $farmName\n";
        $dataStr .= "Date Received: $dateReceived\n";
        $dataStr .= "Receipt Number: $receiptNumber\n";
        $dataStr .= "Email: $email\n";
        $dataStr .= "Postal Address: $postalAddress\n";
        $dataStr .= "Date Sampled: $dateSampled\n";
        $dataStr .= "Contact Phone: $contactPhone\n";
        $dataStr .= "Locality/ICA: $locality\n";
        $dataStr .= "Number of Samples: $numSamples\n";
        $dataStr .= "Average Sub-samples: $avgSubSamples\n";
        $dataStr .= "Earliest Collection Date: $earliestColl\n";
        $dataStr .= "Advisor Name: $advisorName\n\n";

        $dataStr .= "=== SAMPLE IDENTIFICATION & INTENDED CROPS ===\n";
        if ($request->farmerRequestSamples && $request->farmerRequestSamples->count() > 0) {
            foreach ($request->farmerRequestSamples as $sample) {
                $dataStr .= "- Sample Ref: " . ($sample->sample_reference ?? 'N/A') . " | Lab No: " . ($sample->laboratory_number ?? 'N/A') . "\n";
                $dataStr .= "  Previous Crop: " . ($sample->type_of_previous_crop ?? 'Virgin') . "\n";
                $dataStr .= "  Date Ploughed: " . ($sample->date_of_ploughing ?? 'N/A') . "\n";
                $dataStr .= "  Date Planted: " . ($sample->date_planted ?? 'N/A') . "\n";
                $dataStr .= "  Prev Crop Yield: " . ($sample->prev_crop_yield ?? 'N/A') . "\n";
                $dataStr .= "  Intended Crop: " . ($sample->crop ?? 'N/A') . "\n";
                $dataStr .= "  Irrigated (Y/N): " . ($sample->crop_to_be_irrigated ?? 'N/A') . "\n";
                $dataStr .= "  Planting Date: " . ($sample->planting_date ?? 'N/A') . "\n";
                $dataStr .= "  Plant Population/ha: " . ($sample->plant_pop_per_ha ?? 'N/A') . "\n";
                $dataStr .= "  Yield Target (kg/ha): " . ($sample->yield_target_kg_per_ha ?? 'N/A') . "\n";
                $dataStr .= "  Land Size: " . ($sample->land_size ?? 'N/A') . "\n";
                $dataStr .= "  Manure: " . ($sample->manure_to_be_used ?? 'N/A') . "\n";
                $dataStr .= "  Fertilizer: " . ($sample->fertilizer_to_be_used ?? 'N/A') . "\n\n";
            }
        } else {
            $dataStr .= "  No sample details provided.\n\n";
        }

        $dataStr .= "=== SOIL LABORATORY RESULTS ===\n";
        if ($request->soilSampleResult && $request->soilSampleResult->count() > 0) {
            foreach ($request->soilSampleResult as $res) {
                $dataStr .= "Lab No: " . ($res->laboratory_number ?? 'N/A') . " | Ref: " . ($res->soilSample->sample_reference ?? 'N/A') . "\n";
                $dataStr .= "  pH (CaCl2): " . ($res->ph_cacl2 ?? 'N/A') . "\n";
                $dataStr .= "  Colour: " . ($res->colour ?? 'N/A') . "\n";
                $dataStr .= "  Texture: " . ($res->texture ?? 'N/A') . "\n";
                $dataStr .= "  % Sand / Silt / Clay: " . ($res->percentage_sand ?? 'N/A') . "% / " . ($res->percentage_silt ?? 'N/A') . "% / " . ($res->percentage_clay ?? 'N/A') . "%\n";
                $dataStr .= "  Min. Initial N%: " . ($res->min_initial_n ?? 'N/A') . "\n";
                $dataStr .= "  P2O5 (ppm): " . ($res->p2o5_ppm ?? 'N/A') . "\n";
                $dataStr .= "  K (meq%): " . ($res->k ?? 'N/A') . "\n";
                $dataStr .= "  Mg (meq%): " . ($res->mg ?? 'N/A') . "\n";
                $dataStr .= "  Ca (meq%): " . ($res->ca ?? 'N/A') . "\n";
                $dataStr .= "  Zn (ppm): " . ($res->zn ?? 'N/A') . "\n";
                $dataStr .= "  Cu (ppm): " . ($res->cu ?? 'N/A') . "\n";
                $dataStr .= "  Mn (ppm): " . ($res->mn ?? 'N/A') . "\n";
                $dataStr .= "  Fe (ppm): " . ($res->fe ?? 'N/A') . "\n\n";
            }
        } else {
            $dataStr .= "  No soil lab results available.\n\n";
        }

        return $dataStr;
    }

    /**
     * Build the soil analysis interpretation prompt.
     */
    protected function buildAnalysisPrompt(FarmerRequest $request): string
    {
        $dataStr = $this->formatRequestData($request);

        return <<<PROMPT
You are an expert agronomist and soil scientist for the Department of Agricultural Sciences, Zimbabwe.
Generate a professional soil analysis interpretation report. Be thorough and complete. Do NOT truncate.

OUTPUT FORMAT (use exactly this structure):

**SOIL ANALYSIS RESULTS SHEET**

| Lab No | Reference | pH (CaCl₂) | Colour | Texture | % Sand | % Silt | % Clay | Min. Initial N% | P₂O₅ (ppm) | K (meq%) | Mg (meq%) | Ca (meq%) | Zn (ppm) | Cu (ppm) | Mn (ppm) | Fe (ppm) |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| [values...] |

**SOIL INTERPRETATION**

[Write 3-5 professional paragraphs interpreting the soil results covering:
1. Soil texture and physical properties
2. Soil pH and its impact on nutrient availability
3. Macronutrient (N, P, K, Ca, Mg) status and deficiencies
4. Micronutrient (Zn, Cu, Mn, Fe) status
5. Overall soil health assessment and need for amendments]
---

DATA:
$dataStr
PROMPT;
    }

    /**
     * Build the fertilizer and management recommendation prompt.
     */
    protected function buildRecommendationPrompt(FarmerRequest $request): string
    {
        $dataStr = $this->formatRequestData($request);

        return <<<PROMPT
You are an expert agronomist and crop nutritionist for the Department of Agricultural Sciences, Zimbabwe.
Generate a COMPLETE, PROFESSIONAL Agricultural Advisory Services report. Be thorough. Do NOT truncate or summarize — output the entire report.

OUTPUT FORMAT (follow exactly, replacing [placeholders] with real data and calculations):

**SAMPLE IDENTIFICATION / INTENDED CROP DETAILS**

| Lab No | Reference | Prev Crop | Date Ploughed | Date Planted | Prev Yield | Crop | Irrigated | Planting Date | Plant Pop/ha | Yield Target | Land Size | Manure | Fertilizer |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| [one row per sample] |

---

**SOIL ANALYSIS RESULTS SHEET** (Mehlich 3 Extraction)

| Lab No | Reference | pH CaCl₂ | Colour | Texture | % Sand | % Silt | % Clay | Min Initial N% | P₂O₅ ppm | K meq% | Mg meq% | Ca meq% | Zn ppm | Cu ppm | Mn ppm | Fe ppm |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| [one row per result] |

---

**SOIL ADVISORY SUMMARY**

[Write 2-3 paragraphs: describe soil texture, pH level and its implications, nutrient deficiencies noted, and general amendment required. Example style: "Your soils are light textured sandy-loams which are acidic and below the optimum pH range for crop production hence the need for lime application. We recommend DOLOMITIC LIME..."]

---

**FERTILIZER RECOMMENDATIONS FOR INTENSIVE CROP PRODUCTION**

**Basic Treatment**

*a) When beds are prepared for the first time or replanting, broadcast and turn in the following dressings:*

| Field/Lab No | Lime (kg/ha) | Gypsum (kg/ha) | Manure/Compost (kg/ha) | Comments |
|---|---|---|---|---|
| [Calculate based on pH. pH < 5.0 = 2400-2800 kg/ha lime. Gypsum ~400 kg/ha. Manure ~12000 kg/ha] |

*Comments: Lime, Manure/Compost and Gypsum should be broadcasted prior to disc-harrowing.*

---

*b) REGULAR PLANTING DRESSINGS*

[For each intended crop, provide a markdown table:]

| Lab No | Crop | Fertilizer | N (kg/ha) | P₂O₅ (kg/ha) | K₂O (kg/ha) | Rate (kg/ha) |
|---|---|---|---|---|---|---|
| [Use appropriate Zimbabwe regional fertilizers: e.g. Compound L, Compound D, High C Blend, MAP, etc.] |

---

*c) REGULAR TOP-DRESSINGS*

[For each intended crop, write explicit top-dressing instructions. Examples:

**TOMATOES:** Apply 200 kg/ha Ammonium Nitrate (AN) when fruit is marble-sized. Alternate Potassium Nitrate (100 kg/ha) and Calcium Nitrate (100 kg/ha) every 2-3 weeks thereafter. Apply Calcium Nitrate to prevent Blossom End Rot.

**SUGAR BEANS:** Do NOT apply Ammonium Nitrate. Inoculate seed with Rhizobium before planting. Apply foliar sprays from 3-4 weeks after emergence.

**PUMPKINS/BUTTERNUT:** Apply 150 kg/ha AN once. Thereafter alternate Calcium Nitrate and Potassium Nitrate at 2-week intervals. Apply foliars at 4-6 weeks.

**MACADAMIA / FRUIT TREES (if applicable):** Apply SSP at planting. Use CAN or Urea for top-dressing. Apply dolomitic lime around the drip zone. See detailed table below.]

---

[IF macadamia or fruit trees are intended crops, add:]

**FERTILIZER RECOMMENDATIONS FOR MACADAMIA / FRUIT TREES**

| Application | Fertilizer | Rate (kg/tree/annum) | Method |
|---|---|---|---|
| Basal | MAP | 0.5 kg | Broadcast around drip zone |
| Basal | Dolomitic Lime | 1.0 kg | Broadcast |
| Basal | Gypsum | 0.5 kg | Broadcast |
| Basal | Kraal Manure | 10-15 kg | Broadcast |
| Top-dress | CAN or Urea | 0.5 kg | Split 3 applications/year |
| Top-dress | M/P (Mono Potassium Phosphate) | 0.25 kg | Foliar or drench |

---

**NB:** Trace elements such as Zinc, Boron, Copper, Manganese, Molybdenum and Iron can be applied as regular foliar sprays for all crops. Consult your agronomist for specific foliar product recommendations.

---

Yours sincerely,

Shumba Armwell
*(Agronomist and Crop Nutritionist)*
Department of Agricultural Sciences
---

DATA TO USE:
$dataStr
PROMPT;
    }

    /**
     * Make the actual HTTP call to Gemini API with retry logic.
     * On 503 overload errors, automatically falls back to the secondary model.
     */
    protected function callGemini(string $prompt, int $maxRetries = 6): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('GeminiAIService: No API key configured. Set GEMINI_API_KEY in .env');
            return null;
        }

        // Start with primary endpoint; switch to fallback after 2 consecutive 503s
        $activeEndpoint    = $this->endpoint;
        $consecutive503s   = 0;
        $switchedToFallback = false;

        Log::info('GeminiAIService: Sending prompt (length: ' . strlen($prompt) . ' chars) via ' . $activeEndpoint);

        $attempt = 0;
        while ($attempt < $maxRetries) {
            $attempt++;
            try {
                $response = Http::timeout(120)->post($activeEndpoint . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature'     => 0.3,
                        'maxOutputTokens' => 8192,
                        'topP'            => 0.8,
                    ]
                ]);

                if ($response->successful()) {
                    $body         = $response->json();
                    $finishReason = $body['candidates'][0]['finishReason'] ?? 'UNKNOWN';
                    $text         = $body['candidates'][0]['content']['parts'][0]['text'] ?? null;

                    Log::info('GeminiAIService: Success', [
                        'finishReason' => $finishReason,
                        'textLength'   => strlen($text ?? ''),
                        'model'        => $activeEndpoint,
                    ]);

                    if ($finishReason === 'MAX_TOKENS') {
                        Log::warning('GeminiAIService: Output truncated by MAX_TOKENS. Returning partial result.');
                    }

                    return $text;
                }

                $status = $response->status();
                $body   = $response->body();
                Log::warning("GeminiAIService: Attempt $attempt failed", [
                    'status'   => $status,
                    'model'    => $activeEndpoint,
                    'body'     => substr($body, 0, 600),
                ]);

                // On 503 overload: switch to fallback model after 2 consecutive failures
                if ($status === 503) {
                    $consecutive503s++;
                    if (!$switchedToFallback && $consecutive503s >= 2 && $this->fallbackEndpoint) {
                        Log::warning('GeminiAIService: Primary model overloaded. Switching to fallback model: ' . $this->fallbackEndpoint);
                        $activeEndpoint     = $this->fallbackEndpoint;
                        $switchedToFallback = true;
                        $consecutive503s    = 0;
                        sleep(5);
                        continue;
                    }
                } else {
                    $consecutive503s = 0;
                }

                // On 429: check if it is quota-exhausted (unrecoverable) or rate-limited (recoverable)
                if ($status === 429) {
                    $isQuotaExhausted = str_contains($body, 'exceeded your current quota')
                                     || str_contains($body, 'free_tier_requests')
                                     || str_contains($body, 'free_tier_input_token');

                    if ($isQuotaExhausted) {
                        Log::error('GeminiAIService: API quota exhausted (free tier limit reached). Billing must be enabled or quota will reset tomorrow.');
                        return null; // No point retrying — quota is gone
                    }

                    // Recoverable rate limit — retry with backoff
                    if ($attempt < $maxRetries) {
                        $suggestedWait = 0;
                        if (preg_match('/retry in (\d+\.?\d*)s/i', $body, $m)) {
                            $suggestedWait = (int) ceil((float) $m[1]);
                        }
                        $exponential  = min(10 * pow(2, $attempt - 1), 60);
                        $sleepSeconds = max($exponential, $suggestedWait);
                        Log::info("GeminiAIService: Rate limited. Retrying in {$sleepSeconds}s...");
                        sleep($sleepSeconds);
                        continue;
                    }
                }

                // Retry on 503 (service overloaded)
                if ($status === 503 && $attempt < $maxRetries) {
                    $suggestedWait = 0;
                    if (preg_match('/retry in (\d+\.?\d*)s/i', $body, $m)) {
                        $suggestedWait = (int) ceil((float) $m[1]);
                    }
                    $exponential  = min(10 * pow(2, $attempt - 1), 60);
                    $sleepSeconds = max($exponential, $suggestedWait);
                    Log::info("GeminiAIService: Retrying in {$sleepSeconds}s (suggested={$suggestedWait}s, exponential={$exponential}s)...");
                    sleep($sleepSeconds);
                    continue;
                }

                Log::error('GeminiAIService: Non-retryable error', ['status' => $status]);
                return null;

            } catch (\Exception $e) {
                Log::error('GeminiAIService: Exception on attempt ' . $attempt . ': ' . $e->getMessage());
                if ($attempt < $maxRetries) {
                    $sleepSeconds = min(10 * pow(2, $attempt - 1), 60);
                    sleep($sleepSeconds);
                    continue;
                }
                return null;
            }
        }

        Log::error('GeminiAIService: All retry attempts exhausted.');
        return null;
    }
}
