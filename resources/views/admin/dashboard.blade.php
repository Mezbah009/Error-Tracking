@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right"></div>
            </div>
        </div>
    </section>

    @if (isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ $error }}</span>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('news.index') }}" method="POST" enctype="multipart/form-data" id="newsForm"
                target="_blank">
                @csrf

                <div class="card">


                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                            </div>
                        </div>
                    </div>





                    <div class="card-body">

                        <div class="row">

                            <!-- Category Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id">Category (optional)</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Keyword Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="keyword">Keyword</label>
                                    <select name="keyword[]" id="keyword" class="form-control" multiple>
                                        <option value="" disabled>Select keywords...</option>
                                        @foreach ($allKeywords as $keyword)
                                            <option value="{{ $keyword->name }}">{{ $keyword->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Date and Duration Fields -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_date">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control"
                                        value="{{ $yesterday }}">
                                    <p class="error"></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to_date">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control"
                                        value="{{ $today }}">
                                    <p class="error"></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="when">Duration (optional)</label>
                                    <input type="number" name="when" id="when" class="form-control"
                                        placeholder="Filter news by last hour">
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-success">Generate Report</button>
                    {{-- <button type="button" onclick="submitAutoReport();" class="btn btn-success">Auto Report</button> --}}
                </div>
            </form>

            @isset($news)
                <h2 class="mt-5">Search Results</h2>
                <ul class="list-group">
                    @foreach ($news as $article)
                        <li class="list-group-item">
                            <a href="{{ $article['News URL'] }}" target="_blank">{{ $article['News Title'] }}</a>
                            <p>{{ $article['Published Date'] }}</p>
                        </li>
                    @endforeach
                </ul>
            @endisset
        </div>
    </section>
@endsection

@section('customJs')
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    {{-- <script>
        new MultiSelectTag('keyword');
    </script> --}}

    {{-- date formate --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#from_date", {
                dateFormat: "Y-m-d",
                allowInput: true
            });

            flatpickr("#to_date", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            const keywordSelect = document.getElementById('keyword');

            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;

                if (categoryId) {
                    fetchKeywords(categoryId);
                } else {
                    keywordSelect.innerHTML = '';
                    new MultiSelectTag('keyword');
                }
            });

            function fetchKeywords(categoryId) {
                fetch(`/admin/get-keywords-by-category/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        keywordSelect.innerHTML = '';

                        data.forEach(function(keyword) {
                            const option = document.createElement('option');
                            option.value = keyword.name;
                            option.textContent = keyword.name;
                            option.selected = true; // Auto-select keywords
                            keywordSelect.appendChild(option);
                        });

                        new MultiSelectTag('keyword');
                    })
                    .catch(error => {
                        console.error('Error fetching keywords:', error);
                    });
            }

            new MultiSelectTag('keyword');
        });
    </script>
@endsection
