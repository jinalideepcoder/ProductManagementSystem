@extends('layout.master')
@extends('layout.header')
@section('header')
    <title>category</title>
    {{-- <style>
        *:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        a {
            color: #369;
        }

        .title-text {
            margin: 2em 0;
        }

        .table>tbody>tr>td:nth-child(1)>i {
            margin-right: 8px;
            margin-top: 4px;
        }

        .table>tbody>tr>td:nth-child(2) {
            text-align: center;
        }

        .entries {
            margin-top: 0;
        }

        .pagination {
            margin-top: 0 !important;
            margin-left: 13rem;
        }

        .pagination>li>a {
            background-color: white;
            color: #4676d7;
        }


        .pagination>li>a:focus,
        .pagination>li>a:hover,
        .pagination>li>span:focus,
        .pagination>li>span:hover {
            color: #036;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination>.active>a {
            color: white;
            background-color: #4676d7 !Important;
            border: solid 1px #4676d7 !Important;
        }

        .pagination>.active>a:hover {
            background-color: #4676d7 !Important;
            border: solid 1px #4676d7;
        }

        .dataTables_filter {
            margin-left: 11rem;
        }

        .gray {
            color: #e7e7e7;
        }

        .black {
            color: #555555;
        }
    </style> --}}
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
@endsection
@include('layout.sidebar')
@section('content')
    <div class="text-end mb-2">
        <a href="{{ route('categories.create') }}"><button class="btn btn-primary me-5 mb-3">Create</button></a>

    </div>
    @if (\Session::has('success'))
        <div class="alert alert-success text-center m-auto w-25 ">
            <p>{!! \Session::get('success') !!}</p>
        </div>
    @endif

    <table id="categoryTable" class="table table-striped text-center table-bordered w-50 "
        style="float:right;margin-right:20%;">

        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Action</th>
        </thead>
        <tbody>


            @foreach ($categories as $category)
                <tr>
                    <td> {{ $category->id }}</td>
                    <td> {{ \Illuminate\Support\Str::limit($category->name, 25) }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ url('categories/' . "$category->id" . '/edit ') }}"><button
                                    class="btn btn-primary">Edit</button></a>
                            <form action="{{ Route('categories.destroy', ['category' => $category->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary ms-2">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('footer')
    <script>
        const ready = (fn) => {
            if (document.readyState !== "loading") {
                fn();
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        };

        ready(() => {
            let table = new DataTable("#categoryTable", {

                paging: true,
                autoWidth: true,
                responsive: true,
                destroy: true,
                deferRender: true,

                /* responsive */
                responsive: {
                    details: {
                        renderer: (api, rowIdx, columns) => {
                            let data = $.map(columns, (col, i) => {
                                return col.hidden ?
                                    col.data ?
                                    `
                                    <tr class="d-flex flex-column mb-3"
                                  "
                                    >
                                    <td class="d-flex w-100">
                                        <strong>${col.title}:</strong>
                                    </td>
                                    <td class="d-flex w-100">
                                        ${col.data}
                                    </td>
                                    </tr>
                                    ` :
                                    "" :
                                    "";
                            }).join("");

                            return data ? $('<table class="w-100"/>').append(data) : false;
                        }
                    }
                },
                /* end responsive */

                /* columnDefs */
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, row, meta) {
                            if (type === "display") {
                                return (
                                    '<i class="fa fa-external-link" aria-hidden="true"></i>' +
                                    $("<td>")

                                    .text(data)
                                    .wrap("<div></div>")
                                    .parent()
                                    .html()
                                );
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        targets: 1,

                    }
                ]
                /* end columnDefs */
            });
        });
    </script>
@endsection
