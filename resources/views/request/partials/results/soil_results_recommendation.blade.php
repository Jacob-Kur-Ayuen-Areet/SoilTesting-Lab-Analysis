<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- @dd($farmer_request) --}}
                @if (isset($farmer_request))
                    <div class="row">
                        <div class="col-lg-6">
                            @if(Auth::user()->role_id != 2 || $farmer_request->approved == 'Y')
                            <div class="card mt-1 mb-0 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span class="avatar-title rounded">
                                                    .PDF
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col ps-0">
                                            <a href="{{ route('soil_sample_results.generatePdf', $farmer_request->request_id ?? '') }}" class="text-muted fw-bold">Download The Samples and Soil Analysis Result
                                                Sheet</a>
                                            {{-- <p class="mb-0">2.3 MB</p> --}}
                                        </div>
                                        
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="{{ route('soil_sample_results.generatePdf', $farmer_request->request_id ?? '') }}" class="btn btn-link btn-lg text-muted">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if (isset($farmer_request->farmerSampleRecRequest))
                                @if(Auth::user()->role_id != 2 || $farmer_request->farmerSampleRecRequest->approved == 'Y')
                                <div class="card mt-1 mb-0 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded">
                                                        .PDF
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col ps-0">
                                                <a href="{{ route('recommendation.download', $farmer_request->farmerSampleRecRequest->reco_id) }}"
                                                    class="text-muted fw-bold" data-dz-name>Recommenation Doc</a>
                                                <p class="mb-0" data-dz-size></p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="{{ route('recommendation.download', $farmer_request->farmerSampleRecRequest->reco_id) }}"
                                                    class="btn btn-link btn-lg text-muted">
                                                    <i class="ri-download-2-line"></i>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="#" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                        </div> <!-- end col-->

                        @if(Auth::user()->role_id != 2)
                        <div class="col-lg-6">

                            <div class="mb-3 mt-3 mt-xl-0">
                                <label for="sample_recommendation" class="mb-0">Upload Recommendation</label>
                                <p class="text-muted font-14">Recommended pdf file.</p>

                                <form action="{{ route('recommendation.upload') }}" method="post" class="dropzone"
                                    id="myAwesomeDropzone" data-plugin="dropzone"
                                    data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf
                                    <input type="text" class="form-control" id="new_request_id"
                                        value="{{ $farmer_request->request_id ?? '' }}" name="request_id"
                                        hidden>
                                    <input type="text" class="form-control" id="new_request_id"
                                        value="{{ $farmer_request->request_id ?? '' }}" name="request_id"
                                        hidden>

                                    <div class="fallback">
                                        <input name="file" type="file" id="file" />
                                    </div>


                                    <div class="dz-message needsclick">
                                        <i class="h3 text-muted ri-upload-cloud-2-line"></i>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </form>

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded">
                                                            .PDF
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col ps-0">
                                                    <a href="javascript:void(0);" class="text-muted fw-bold"
                                                        data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="#" class="btn btn-link btn-lg text-muted"
                                                        data-dz-remove>
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <form id="form-wizard" action="{{ route('recommendation.update') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="request_id"
                                        value="{{ $farmer_request->request_id ?? '' }}" name="request_id"
                                        hidden>
                                    <input type="text" class="form-control" id="new_request_id"
                                        value="{{ $farmer_request->request_id ?? '' }}" name="request_id"
                                        hidden>
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Comment</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="2"
                                            placeholder="Enter some brief comments..">{{ $farmer_request->farmerSampleRecRequest->notes ?? '' }}</textarea>
                                    </div>
                                    <label for="approved" class="form-label">Approve</label>

                                    <select class="form-control " id="approved" name="approved">
                                        <option value="N"
                                            {{ ($farmer_request->farmerSampleRecRequest->approved ?? 'N') == 'N' ? 'selected' : '' }}>
                                            No</option>
                                        <option value="Y"
                                            {{ ($farmer_request->farmerSampleRecRequest->approved ?? 'N') == 'Y' ? 'selected' : '' }}>
                                            Yes</option>

                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>
                                <!-- end file preview template -->
                            </div>

                            <!-- Date View -->
                            </form>
                        </div> <!-- end col-->
                        @elseif(isset($farmer_request->farmerSampleRecRequest) && $farmer_request->farmerSampleRecRequest->notes)
                        <div class="col-lg-6">
                            <div class="card mt-1 mb-0 shadow-none border">
                                <div class="card-body">
                                    <h5 class="card-title">Comment</h5>
                                    <p class="card-text">{{ $farmer_request->farmerSampleRecRequest->notes }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- ═══ AI RECOMMENDATION PANEL (admin only) ══════════════════════════════════ --}}
                    @if(Auth::check() && Auth::user()->role_id == 1)
                    @php
                        $rec = $farmer_request->farmerSampleRecRequest;
                        $aiStatus = $rec->ai_status ?? 'none';
                        $aiText = $rec->ai_text ?? '';
                        $recId = $rec ? $rec->reco_id : $farmer_request->request_id;
                    @endphp
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border border-light shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="header-title mb-0">
                                            <i class="ri-robot-line me-1 text-primary"></i>
                                            AI Soil Analysis & Fertilizer Recommendation
                                        </h5>
                                        <span id="ai-rec-status-badge" class="badge fs-6
                                            {{ $aiStatus === 'approved'   ? 'bg-success' :
                                               ($aiStatus === 'pending'    ? 'bg-warning text-dark' :
                                               ($aiStatus === 'rejected'   ? 'bg-danger' :
                                               ($aiStatus === 'processing' ? 'bg-info text-white' :
                                               ($aiStatus === 'failed'     ? 'bg-danger' : 'bg-secondary')))) }}">
                                            @if($aiStatus === 'processing') ⏳ Generating…
                                            @elseif($aiStatus === 'failed') ❌ Failed — Please Retry
                                            @elseif($aiStatus === 'none') Not Generated
                                            @else {{ ucfirst($aiStatus) }}
                                            @endif
                                        </span>
                                    </div>

                                    <textarea id="ai-rec-text" class="form-control mb-3" rows="12"
                                        placeholder="Click 'Generate AI Recommendation' to interpret results and create a complete Agricultural Advisory Services report..."
                                        style="font-size:0.92rem; line-height:1.6; font-family: 'Courier New', Courier, monospace;">{{ $aiText }}</textarea>

                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" id="btn-ai-rec-generate"
                                            class="btn btn-primary"
                                            data-url="{{ route('recommendation.ai.recommend', $recId) }}"
                                            data-status-url="{{ route('recommendation.ai.status', $recId) }}"
                                            {{ in_array($aiStatus, ['processing']) ? 'disabled' : '' }}>
                                            <i class="ri-robot-line me-1"></i>
                                            <span id="btn-ai-rec-generate-text">
                                                {{ $aiStatus === 'processing' ? '⏳ Generating…' : ($aiStatus === 'failed' ? 'Retry AI Generation' : 'Generate AI Recommendation') }}
                                            </span>
                                        </button>

                                        @if(in_array($aiStatus, ['pending', 'approved', 'rejected', 'failed']))
                                        @if(in_array($aiStatus, ['pending', 'approved', 'rejected']))
                                        <button type="button" id="btn-ai-rec-approve"
                                            class="btn btn-success"
                                            data-url="{{ route('recommendation.ai.approve', $recId) }}">
                                            <i class="ri-checkbox-circle-line me-1"></i> Approve & Publish
                                        </button>
                                        @endif
                                        <button type="button" id="btn-ai-rec-reject"
                                            class="btn btn-outline-danger"
                                            data-url="{{ route('recommendation.ai.reject', $recId) }}">
                                            <i class="ri-close-circle-line me-1"></i> Reject
                                        </button>
                                        @endif
                                    </div>

                                    @if($aiStatus === 'approved')
                                    <div class="alert alert-success mt-3 mb-0 py-2">
                                        <i class="ri-check-line me-1"></i>
                                        This AI recommendation is <strong>approved</strong> and visible to the farmer.
                                    </div>
                                    @elseif($aiStatus === 'pending')
                                    <div class="alert alert-warning mt-3 mb-0 py-2">
                                        <i class="ri-eye-off-line me-1"></i>
                                        <strong>Pending review</strong> — hidden from farmer until approved.
                                    </div>
                                    @elseif($aiStatus === 'processing')
                                    <div class="alert alert-info mt-3 mb-0 py-2">
                                        <i class="ri-loader-line me-1"></i>
                                        <strong>Generating…</strong> The AI is working on the report. This page will refresh automatically.
                                    </div>
                                    @elseif($aiStatus === 'failed')
                                    <div class="alert alert-danger mt-3 mb-0 py-2">
                                        <i class="ri-error-warning-line me-1"></i>
                                        <strong>Generation failed</strong> — the Gemini API was busy. Please click <em>Retry AI Generation</em> to try again.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @else
                    <h3>Request Not Found !!</h3>
                @endif
                <!-- end row -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

@if(Auth::check() && Auth::user()->role_id == 1)
<script>
(function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    let pollInterval = null;

    function aiPost(url, body) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(body),
        }).then(r => r.json());
    }

    function aiGet(url) {
        return fetch(url, {
            method: 'GET',
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        }).then(r => r.json());
    }

    function setBadge(status) {
        const badge = document.getElementById('ai-rec-status-badge');
        if (!badge) return;
        const map = {
            approved:   'bg-success',
            pending:    'bg-warning text-dark',
            rejected:   'bg-danger',
            processing: 'bg-info text-white',
            failed:     'bg-danger',
            none:       'bg-secondary',
        };
        badge.className = 'badge fs-6 ' + (map[status] || 'bg-secondary');
        const labels = { processing: '⏳ Generating…', failed: '❌ Failed', none: 'Not Generated' };
        badge.textContent = labels[status] ?? (status.charAt(0).toUpperCase() + status.slice(1));
    }

    function stopPolling() {
        if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
    }

    function startPolling(statusUrl) {
        stopPolling();
        pollInterval = setInterval(function() {
            aiGet(statusUrl).then(data => {
                setBadge(data.status);
                if (data.status === 'pending' || data.status === 'approved') {
                    document.getElementById('ai-rec-text').value = data.text ?? '';
                    stopPolling();
                    // Reload so approve/reject buttons appear
                    location.reload();
                } else if (data.status === 'failed') {
                    stopPolling();
                    const btnText = document.getElementById('btn-ai-rec-generate-text');
                    if (btnText) btnText.textContent = 'Retry AI Generation';
                    const btn = document.getElementById('btn-ai-rec-generate');
                    if (btn) btn.disabled = false;
                    alert('AI generation failed. The API may be busy — please try again in a minute.');
                }
            }).catch(() => { /* network blip — keep polling */ });
        }, 3000); // poll every 3 seconds
    }

    // GENERATE
    const btnGenerate = document.getElementById('btn-ai-rec-generate');
    if (btnGenerate) {
        btnGenerate.addEventListener('click', function() {
            const generateUrl = this.dataset.url;
            const statusUrl   = this.dataset.statusUrl;
            const btnText     = document.getElementById('btn-ai-rec-generate-text');

            btnText.textContent = '⏳ Generating…';
            btnGenerate.disabled = true;
            setBadge('processing');

            aiPost(generateUrl, {}).then(data => {
                if (data.status === 'processing') {
                    // Job dispatched — start polling
                    startPolling(statusUrl);
                } else if (data.error) {
                    alert('Error: ' + data.error);
                    btnText.textContent = 'Generate AI Recommendation';
                    btnGenerate.disabled = false;
                    setBadge('none');
                }
            }).catch(() => {
                alert('Request failed. Check your connection.');
                btnText.textContent = 'Generate AI Recommendation';
                btnGenerate.disabled = false;
            });
        });
    }

    // APPROVE
    const btnApprove = document.getElementById('btn-ai-rec-approve');
    if (btnApprove) {
        btnApprove.addEventListener('click', function() {
            const url        = this.dataset.url;
            const editedText = document.getElementById('ai-rec-text').value;
            btnApprove.disabled = true;
            aiPost(url, { ai_text: editedText }).then(data => {
                if (data.status === 'approved') { setBadge('approved'); location.reload(); }
            }).catch(() => alert('Approve request failed.'))
              .finally(() => btnApprove.disabled = false);
        });
    }

    // REJECT
    const btnReject = document.getElementById('btn-ai-rec-reject');
    if (btnReject) {
        btnReject.addEventListener('click', function() {
            if (!confirm('Reject and clear this AI recommendation? The farmer will not see it.')) return;
            const url = this.dataset.url;
            btnReject.disabled = true;
            aiPost(url, {}).then(data => {
                if (data.status === 'rejected') {
                    document.getElementById('ai-rec-text').value = '';
                    setBadge('rejected');
                    location.reload();
                }
            }).catch(() => alert('Reject request failed.'))
              .finally(() => btnReject.disabled = false);
        });
    }

    // If page loads with status=processing, auto-start polling
    const badge = document.getElementById('ai-rec-status-badge');
    if (badge && badge.textContent.trim() === '⏳ Generating…') {
        const btn = document.getElementById('btn-ai-rec-generate');
        if (btn) startPolling(btn.dataset.statusUrl);
    }
})();
</script>
@endif

