<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintanance - KGTK Bengkulu</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1a1a1a;
        }

        .content {
            max-width: 400px;
            padding: 20px;
        }

        /* Ikon Garis Simpel */
        .line-icon {
            width: 48px;
            height: 2px;
            background: #2563eb;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 24px;
        }

        .brand {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #999;
            font-weight: 600;
        }

        /* Titik loading kecil di pojok */
        .loading-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            background: #2563eb;
            border-radius: 50%;
            margin-left: 4px;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="line-icon"></div>
        <span class="brand">KGTK Bengkulu</span>
        <h1>Sedang Pemeliharaan</h1>
        <p>
            Kami sedang memperbarui beberapa fitur untuk kenyamanan Anda. Website akan segera kembali normal dalam waktu
            dekat.
        </p>
        <p style="font-size: 13px;">
            Harap tunggu sebentar<span class="loading-dot"></span>
        </p>
    </div>

</body>

</html>
