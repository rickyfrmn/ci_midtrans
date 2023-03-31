<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- script Checkout -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-RayaH1EHMnJiBti4"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>Aplikasi pembayaran spp</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="<?php echo base_url('asset\image\logo1.jpg') ?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Mengkeren
            </a>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Daftar pembayaran spi</h2>
        <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
            <input type="hidden" name="result_type" id="result-type" value=""></div>
            <input type="hidden" name="result_data" id="result-data" value=""></div>
            <label for="nama">Nama siswa</label>
            <div class="form group">
                <input type="text" class="form-control" name="nama" id="nama">
            </div>
            <label for="kelas">Kelas</label>
            <div class="form group">
                <select name="kelas" id="kelas" class="form-control">
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <label for="jmlbayar">Jumlah bayar</label>
            <div class="form group">
                <input type="text" class="form-control" name="jmlbayar" id="jmlbayar">
            </div>
            <button class="btn btn-primary" id="pay-button">Bayar</button>
        </form>
    </div>
    <script type="text/javascript">
    
        $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        
        // memberi variabel untuk jenis pembayaran
        var nama = $("#nama").val();
        var kelas = $("#kelas").val();
        var jmlbayar = $("#jmlbayar").val();
        $.ajax({
        type: 'POST',    
        url: '<?=site_url()?>/snap/token',
        data: {
            nama:nama,
            kelas:kelas,
            jmlbayar:jmlbayar
        },
        cache: false,

        success: function(data) {
            //location = data;

            console.log('token = '+data);
            
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type,data){
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {
            
            onSuccess: function(result){
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
            },
            onPending: function(result){
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            },
            onError: function(result){
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            }
            });
        }
        });
    });

    </script>
</body>
</html>