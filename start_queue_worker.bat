@echo off
echo Starting Laravel Queue Listener...
echo This window must stay open for AI Recommendations and Soil Analysis generation to work in the background.
php artisan queue:listen --tries=6 --timeout=900
