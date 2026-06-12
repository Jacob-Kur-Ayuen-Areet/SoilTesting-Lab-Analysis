<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>AI Recommendation</title>
    <style>
        body {
            line-height: 1.5;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11pt;
            color: #333;
            margin: 40px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            font-size: 18pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .ai-content {
            margin-top: 20px;
            white-space: pre-wrap;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 9pt;
            color: #7f8c8d;
            border-top: 1px solid #bdc3c7;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Soil Analysis Recommendation</h1>
        <p><strong>Department of Agricultural Sciences, Soil Science Laboratory</strong></p>
    </div>

    <div class="ai-content">
        {!! nl2br(e($ai_text)) !!}
    </div>

    <div class="footer">
        <p>Generated automatically by SOILI AI Recommendation System</p>
    </div>
</body>
</html>
