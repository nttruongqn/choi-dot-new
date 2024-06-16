<!DOCTYPE html>
<html lang="en">
<base href="{{ asset('public') }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"
        integrity="sha512-MqL4+Io386IOPMKKyplKII0pVW5e+kb+PI/I3N87G3fHIfrgNNsRpzIXEi+0MQC0sR9xZNqZqCYVcC61fL5+Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body class="sb-nav-fixed">
    @include('admin.layouts.header')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.layouts.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-2">
                    @yield('main')
                </div>
            </main>
            @include('admin.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="commons/common.js"></script>
    <script src="admin/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="admin/assets/demo/chart-area-demo.js"></script>
    <script src="admin/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="admin/js/datatables-simple-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- include libraries(jQuery, bootstrap) -->
    {{-- <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" /> --}}
    <script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $('#content-custom').summernote({
            height: 300,
            placeholder: 'Nhập nội dung',
            tabsize: 2,
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Roboto', 'Times New Roman',
                'Trebuchet MS'
            ],
            fontNamesIgnoreCheck: ['Roboto', 'Times New Roman', 'Trebuchet MS'],

        })
    </script>

    <script>
        $('#content-article-custom').summernote({
            height: 300,
            placeholder: 'Nhập nội dung',
            tabsize: 2,
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Roboto', 'Times New Roman',
                'Trebuchet MS'
            ],
            fontNamesIgnoreCheck: ['Roboto', 'Times New Roman', 'Trebuchet MS'],

        })
    </script>

    <script>
        const loadFile = function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('isDeleteAvatar').setAttribute('value', 'false');
        };

        const loadFileChildrenFirst = function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('output_first');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('isDeleteFC').setAttribute('value', 'false');
        };

        const loadFileChildrenSecond = function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('output_second');
                output.src = reader.result;

            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('isDeleteSC').setAttribute('value', 'false');
        };

        const loadFileImageArticle = function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('output_article');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            document.getElementById('iDAI').setAttribute('value', 'false');
        };

        const removeAvatar = function() {
            const output = document.getElementById('output');
            const isDeleteAvatar = document.getElementById('isDeleteAvatar');
            output.src = 'assets/images/no_image.png';
            isDeleteAvatar.setAttribute('value', 'true');
            document.getElementById('avatar').value = null;
        };
        const removeFC = function() {
            const output = document.getElementById('output_first');
            const isDeleteFC = document.getElementById('isDeleteFC');
            output.src = 'assets/images/no_image.png';
            isDeleteFC.setAttribute('value', 'true');
            document.getElementById('avatar_first_child').value = null;

        };
        const removeSC = function() {
            const output = document.getElementById('output_second');
            const isDeleteSC = document.getElementById('isDeleteSC');
            output.src = 'assets/images/no_image.png';
            isDeleteSC.setAttribute('value', 'true');
            document.getElementById('avatar_second_child').value = null;
        };
        const removeImageArticle = function() {
            const output = document.getElementById('output_article');
            const isDeleteImageArticle = document.getElementById('iDAI');
            console.log('v', isDeleteImageArticle);
            output.src = 'assets/images/no_image.png';
            isDeleteImageArticle.setAttribute('value', 'true');
            document.getElementById('image_title').value = null;

        };
    </script>
    <script>
        const systemRouteName = ['user.index', 'category.index', 'product.index', 'article.index']
        const cartRouteName = ['checkout.index']
        const dashboardRouteName = ['admin.index']
        const routeName = "{{ Request::route()->getName() }}"
        systemRouteName.includes(routeName) && document.getElementById("collapse-system").click();
        cartRouteName.includes(routeName) && document.getElementById("collapsed-cart").click();
    </script>
    @yield('script')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>

</body>

</html>
