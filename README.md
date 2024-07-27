<h2>SPA with API for creating tasks in Kommo CRM</h2>

<h4>For testin puproses you can use local server </h4>
<ul>
    <li>Configure .env file, migrate database.</li>
    <li>Install all dependencies.</li> 
    <li>Make integration (after loging to Kommo account, head to settings->integrations, choose installed and then create your integration.</li>
    <li><h3>Create your Secret Key, Integration ID and Authorization code, and fill them in variables at TokenService.php (in app->Service) and don't forget to write your subdomain (name before kommo.com) in BaseService.php (same location)<h3></li>
    <li>Create refresh token according to https://www.kommo.com/developers/content/oauth/oauth/ then start local server</li>
    <li>Start your server and Vite (npm run dev)</li>
</ul>

## About this app:
This app allows you to create tasks for a cerctain period of time. According to test task, it have 2 validations, 
<ul>
<li>first one is on frontend part, that checks if selected user is free on this time (basicly user can have only 1 task for 1 period of time)</li>
<li>second on is on backend part, after you send data to API</li>
