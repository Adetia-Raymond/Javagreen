@extends('template.layouts.user_type.auth')
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner</title>
</head> --}}
@section('content')
    <script src="{{ asset('js/html5-qrcode/html5-qrcode.min.js') }}"></script>

    <style>
        /* Default styles for the reader div */
        #reader {
            /* width: 300px;
                height: 300px;
                margin: auto; */

        }

        /* Styles for larger screens */
        @media (min-width: 768px) {
            #reader {
                width: 700px;
                /* Smaller size for desktop */
                height: 700px;
                /* Smaller size for desktop */
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center
        }
    </style>
    <div>

        <h1>Pindai Kode QR pada Pot Pintar</h1>
        <div class="container">
            <div id="reader" class="reader"></div>
        </div>

        <script type="text/javascript">
            function onScanSuccess(decodedText, decodedResult) {
                // Regex pattern to match URLs of the form: https://mydomain.com/scanned/{unique_code}
                // const urlPattern = /^https?:\/\/mydomain\.com\/scanned\/[a-zA-Z0-9_-]+$/;

                // test url using development port server
                const urlPattern = /^http:\/\/127\.0\.0\.1:8000\/addtoken\/[a-zA-Z0-9_-]+$/;

                // Check if the scanned QR code matches the pattern
                if (urlPattern.test(decodedText)) {
                    console.log(`Valid URL scanned = ${decodedText}`, decodedResult);

                    // Redirect to the scanned URL
                    window.location.href = decodedText;
                    alert(`SUKSES Menambahkan alat, Silahkan tekan tombol OK`);
                } else {
                    console.warn(`Invalid URL scanned = ${decodedText}`);
                    alert(`Kode QR Tidak Valid, Mohon Coba Kembali`);
                }
            }

            function onScanFailure(error) {
                // Handle scan failure, usually better to ignore and keep scanning.
                console.warn(`Code scan error = ${error}`);
            }

            // Initialize the QR code scanner with higher resolution and larger qrbox
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 300,
                        height: 300
                    }, // Increase the size of the qrbox
                    aspectRatio: 1.0 // Maintain aspect ratio
                },
                true // Verbose mode
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    </div>
    <style>
        .btn {
            background: #0066ec;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #67fcca, #0086ec);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #67fcca, #0086ec);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff;
            border: 3px solid #eee;
            width: 100%;
            font-size: 12px
        }
    </style>
    <div class="card mb-4 mt-4">
        <div class="card-body pl-5 pt-4 pb-2">
            <a href="{{ route('menutoken') }}">
                <button class="btn">Kembali</button>
            </a>
        </div>
    </div>
@endsection
