<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .container {
        display: flex;
        min-width: 100%;
        min-height: 100%;
    }
</style>

<body>
    <div>hallo {{ $data['nama'] }}</div>

    <div class="container">
        {{-- <iframe id="myIframe" width='100%' height='500px' src=""></iframe> --}}
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        var mimeContentType = '<?php echo $data['fileMeta']['mimeContentType']; ?>'
        var extentionFile = '<?php echo $data['fileMeta']['extension']; ?>'
        // 'data:image/jpeg;base64,"+mapImages[valJ][1]+"'
        let srcPdf = `{{ asset('/dokumen/pka/pka - 210823 file pdf uji coba upload.pdf') }}`
        var src = 'http://127.0.0.1:8000/dokumen/pka/avatar.png';
        let base64FromPHP = `{{ $data['base64'] }}`

        var srcBase64 = `data:${mimeContentType};base64,"{{ $data['base64'] }}"`

        // var iframe = `<iframe id="myIframe" width='100%' height='500px' src=""></iframe>`;
        let iframes = document.createElement('iframe')
        iframes.setAttribute("width", "100%");
        iframes.setAttribute("height", "500px");
        iframes.setAttribute("src", srcBase64)

        var container = document.querySelector('.container');
        container.append(iframes)

        // container.html(iframe)
    });
</script>

</html>
