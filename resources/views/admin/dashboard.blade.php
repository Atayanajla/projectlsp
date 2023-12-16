<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">


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

    <center>
        <div class="container" >
            <div class="w-full overflow-hidden rounded-lg lg:mt-10 my-26 border-line-stroke">
                <div class="bg-white w-full py-3 lg:py-4 xl:text-lg d-flex justify-content-between align-items-center">
                    <h1 class="font-semibold text-darker-black">Data Mahasiswa</h1>
                    <a href="/create/users" class="btn btn-outline-primary btn-md font-semibold text-darker-black">Tambah Data</a>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table table-striped table-hover" id="myTable">
                        <thead>
                            <tr
                                class="text-xs lg:text-sm font-semibold tracking-wide text-left text-dark-grey uppercase border-b bg-gray-100 lg:text-center">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Mahasiswa</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Alamat KTP</th>
                                <th class="px-4 py-3">Alamat Sekarang</th>
                                <th class="px-4 py-3">Kewarganegaraan</th>
                                <th class="px-4 py-3">Agama</th>
                                <th class="px-4 py-3">Status Menikah</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach ($users as $user)
                                <tr class="text-darker-black lg:text-center text-xs lg:text-sm">
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->namaLengkap }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->alamatKTP }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->alamatSaatIni }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->kewarganegaraan }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->agama }}</td>
                                    <td class="px-4 py-3 text-xs lg:text-sm">{{ $user->statusMenikah }}</td>
                                    <td><a href="/admin/update/{{ $user->id }}" class="btn btn-primary mb-2 w-100">View</a>
                                        <a href="/admin/delete-{{ $user->id }}/store" class="btn btn btn-warning mb-2 w-100">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>


    <script>
        let table = new DataTable('#myTable', {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>


    <script>
        @if(Session::has("berhasilLogin"))
            toastr.success("Selamat Datang Lagi...");
        @endif
    </script>
</body>

</html>
