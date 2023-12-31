<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse p-1" id="navbarNav">
                <div class="nav-item dropdown mx-auto d-flex">
                    <button class="btn btn-dark dropdown-toggle text-primary" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->namaLengkap }}</button>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <p class="text-center mt-4 fs-3 fw-bold">Ubah Data Mahasiswa</p>

    <form class="col-md-5 m-5 mx-auto" action="/admin/update-{{ $getUser->id }}/store" method="post">
        @csrf
        @method('put')
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nama Lengkap</span>
            <input type="text" name="namaLengkap" class="form-control" value="{{ $getUser->namaLengkap }}"
                aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Alamat KTP</span>
            <input type="text" value="{{ $getUser->alamatKTP }}"  name="alamatKTP" class="form-control" placeholder="Alamat KTP" aria-label="Recipient's username"
                aria-describedby="basic-addon2">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Alamat Lengkap Sekarang</span>
            <input type="text" value="{{ $getUser->alamatSaatIni }}"  name="alamatSaatIni" class="form-control" placeholder="Alamat Lengkap Saat ini"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text">Provinsi</span>
            <select class="provinsi w-50 " name="provinsi">
                <option readonly selected>PROVINSI SAAT INI: {{ $getUser->provinsi }}</option>
                @foreach ($provinsiData['value'] as $provinsi)
                <option data-id-provinsi={{ $provinsi["id"] }} value="{{ $provinsi['name'] }}">{{ $provinsi['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Kabupaten</span>
            <select class="kabupaten w-50" name="kabupaten">
                <option readonly selected>KABUPATEN SAAT INI: {{ $getUser->kabupaten }}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Kecamatan</span>
            <select class="kecamatan w-50" name="kecamatan">
                <option readonly selected>KECAMATAN SAAT INI: {{ $getUser->kecamatan }}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">No Telp</span>
            <input type="number" name="noTelpon" value="{{ $getUser->noTelpon }}" class="form-control" placeholder="NoTelp" aria-label="NoTelp">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">No HP</span>
            <input type="number" value="{{ $getUser->noHp }}"  name="noHp" class="form-control" placeholder="NoHp" aria-label="NoHp">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="email" name="email" disabled class="form-control" value="{{ $getUser->email }}" aria-label="email">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Kewarganegaraan</span>
            <select class="w-50 form-control" name="kewarganegaraan">
                <option value="">select</option>
                <option @if ($getUser->kewarganegaraan === "WNI Asli") selected @endif value="WNI Asli">WNI Asli</option>
                <option @if ($getUser->kewarganegaraan === "WNI Keturunan") selected @endif value="WNI Keturunan">WNI Keturunan</option>
                <option @if ($getUser->kewarganegaraan === "WNA") selected @endif value="WNA">WNA</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Tanggal Lahir</span>
            <input type="date" name="tgl_lahir" class="form-control" value="{{ $getUser->tgl_lahir }}">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Tempat Lahir</span>
            <input type="text" name="tmp_lahir" class="form-control" placeholder=".." value="{{ $getUser->tmp_lahir }}">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Jenis Kelamin</span>
            <select class="w-50 pilihan" name="jk">
                <option value="">select</option>
                <option @if ($getUser->jk === "pria") selected @endif value="pria">Pria</option>
                <option @if ($getUser->jk === "wanita") selected @endif value="wanita">wanita</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Status Menikah</span>
            <select class="w-50 pilihan" name="statusMenikah">
                <option value="">select</option>
                <option @if ($getUser->statusMenikah === "Belum Menikah") selected @endif value="Belum Menikah">Belum Menikah</option>
                <option @if ($getUser->statusMenikah === "Menikah") selected @endif value="Menikah">Menikah</option>
                <option @if ($getUser->statusMenikah === "Lain-lain (janda/duda)") selected @endif value="Lain-lain (janda/duda)">Lain-lain (janda/duda)</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Agama</span>
            <select class="w-50 pilihan" name="agama">
                <option @if ($getUser->agama === "Islam")  selected @endif value="Islam">Islam</option>
                <option @if ($getUser->agama === "Katolik") selected @endif  value="Katolik">Katolik</option>
                <option @if ($getUser->agama === "Kristen") selected @endif  value="Kristen">Kristen</option>
                <option @if ($getUser->agama === "Hindu") selected @endif  value="Hindu">Hindu</option>
                <option @if ($getUser->agama === "Budha") selected @endif value="Budha">Budha</option>
                <option @if ($getUser->agama === "lain-lain") selected @endif value="lain-lain">lain-lain</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Foto Profile</span>
            <input type="file" class="form-control" name="imgProfile">
        </div>

        <div class="d-flex justify-content-between w-100">
            <button type="submit" class="btn btn-primary w-25 mt-3">Edit</button>
            <a href="/admin/dashboard" class="btn btn-outline-dark w-25 mt-3">Back</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var $jq = jQuery.noConflict();

        $jq(document).ready(function() {
            $jq('.provinsi').select2();
        });

        $jq(document).ready(function() {
            $jq('.kabupaten').select2();
        });

        $jq(document).ready(function() {
            $jq('.kecamatan').select2();
        });
        $jq(document).ready(function() {
            $jq('.pilihan').select2();
        });
    </script>

    <script>
        jQuery(document).ready(function(e) {
            jQuery('.provinsi').select2();

            jQuery('.provinsi').on('change', function() {
                var idProvinsi = jQuery(this).find(':selected').data('id-provinsi');

                if (idProvinsi === undefined) {
                    console.log('Error: id_provinsi is undefined');
                    return;
                }

                console.log('Selected id_provinsi:', idProvinsi);

                // Fetch kabupaten data based on the selected provinsi
                jQuery.ajax({
                    url: 'https://api.binderbyte.com/wilayah/kabupaten',
                    type: 'GET',
                    data: {
                        api_key: '{{ $apiKey }}',
                        id_provinsi: idProvinsi,
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Check if data is not null or undefined
                        if (response && response.code === '200' && response.value) {
                            var kabupatenData = response.value;

                            jQuery('.kabupaten').empty();

                            jQuery.each(kabupatenData, function(index, kabupaten) {
                                jQuery('.kabupaten').append('<option data-id-kabupaten="'+ kabupaten.id + '" value="' + kabupaten.name + '">' + kabupaten.name + '</option>');
                            });

                            jQuery('.kabupaten').select2();
                        } else {
                            console.log('Empty or null response from the API.');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        jQuery(document).ready(function(e) {
            jQuery('.kabupaten').select2();

            jQuery('.kabupaten').on('change', function() {
                var idKabupaten = jQuery(this).find(":selected").data('id-kabupaten');

                if (idKabupaten === undefined) {
                    console.log('Error: id_kabupaten is undefined');
                    return;
                }

                console.log('Selected id_kabupaten:', idKabupaten);

                // Fetch kabupaten data based on the selected provinsi
                jQuery.ajax({
                    url: 'https://api.binderbyte.com/wilayah/kecamatan',
                    type: 'GET',
                    data: {
                        api_key: '{{ $apiKey }}',
                        id_kabupaten: idKabupaten,
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Check if data is not null or undefined
                        if (response && response.code === '200' && response.value) {
                            var kecamatanData = response.value;

                            jQuery('.kecamatan').empty();

                            jQuery.each(kecamatanData, function(index, kecamatan) {
                                jQuery('.kecamatan').append('<option value="' + kecamatan.name + '">' + kecamatan.name + '</option>');
                            });

                            jQuery('.kecamatan').select2();
                        } else {
                            console.log('Empty or null response from the API.');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

</body>

</html>
