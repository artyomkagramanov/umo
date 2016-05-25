<?php

return [

    'linkedin' => [

                'client_id' => '774nly9ft78yfr',
                'client_secret' => 'IuMvwoBrR8ox0hnr',
                'redirect_uri' => env('PROTOCOL').env('HOST').'/linkedin-callback'
                ],
    'google' => [

                'client_id' => '985007318564-hjict4vm311a75doj0ght871udj32mmg.apps.googleusercontent.com',
                'client_secret' => 'UBEPmS5oOgOMS4I9Mx9j2Z0E',
                'redirect_uri' => env('PROTOCOL').env('HOST').'/google-callback'
                ],


];
