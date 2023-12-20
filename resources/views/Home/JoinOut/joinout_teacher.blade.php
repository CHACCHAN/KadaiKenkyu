<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Vite --}}
    @vite('resources/sass/app.scss')
    {{-- CSS --}}
    <style>
        @keyframes Live {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        #Live {
            animation: Live 2s linear infinite;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 bg-primary position-relative">
            <div class="h4 mt-2 text-center text-light">教員出席状況モニター</div>
            <div id="Live" class="position-absolute text-danger h3" style="top: 6px; right: 10px;">LIVE</div>
        </div>
        <div class="col-12">
            {{-- 出席者名 --}}
            <div id="CardBody" class="row">
                @foreach($joinouts as $joinout)
                    @if(\App\Models\User::where('id', '=', $joinout->user_id)->first()->admin_flag)
                        <div class="col-3">
                            <div class="card mt-3 mx-2">
                                <div id="CardBody_{{ $joinout->id }}" class="card-body @if($joinout->flag) bg-success @else bg-secondary @endif">
                                    <div class="text-center text-light">
                                        {{ $joinout->first_name }} {{ $joinout->last_name }} 先生
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            {{-- ステータス説明 --}}
            <div class="d-flex mx-3 mt-5">
                <div class="d-flex me-3">
                    <div class="bg-success px-4 py-2" style="width: 10px;"></div>
                    <div class="fs-6 ms-1">出席中</div>
                </div>
                <div class="d-flex">
                    <div class="bg-secondary px-4 py-2" style="width: 10px;"></div>
                    <div class="fs-6 ms-1">退席中</div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Vite --}}
@vite('resources/js/app.js')
{{-- JS --}}
<script type="text/javascript">
    let Keys = [
        @foreach($joinouts as $joinout)
            @if(\App\Models\User::where('id', '=', $joinout->user_id)->first()->admin_flag)
                {{ $joinout->id }},
            @endif
        @endforeach
    ];

    setInterval(() => {
        Keys.forEach(function(e) {
            fetch('{{ route('Home.joinout.api') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: e,
                }),
            })
            .then((response) => response.json())
            .then(res => {
                let Target = document.getElementById('CardBody_' + e);
                if(res.flag) {
                    Target.classList.remove('bg-secondary');
                    Target.classList.add('bg-success');
                } else {
                    Target.classList.remove('bg-success');
                    Target.classList.add('bg-secondary');
                }
            })
            .catch(error => {
                console.log(error);
            });
        });
    }, 5000);
</script>
</body>
</html>