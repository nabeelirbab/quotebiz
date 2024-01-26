
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to HTML</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        span {
            color: #0366d6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>XML Sitemap</h1>
    </header>

    <main id="xmlToHtml">
        <p>This sitemap contains {{ count($xml->url) }} URLs.</p>
        <table>
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Last Modified</th>
                    <th>Change Frequency</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                @foreach($xml->url as $url)
                    <tr>
                        <td><a href="{{ $url->loc }}">{{ $url->loc }}</a></td>
                        <td>{{ $url->lastmod }}</td>
                        <td>{{ $url->changefreq }}</td>
                        <td>{{ $url->priority }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
