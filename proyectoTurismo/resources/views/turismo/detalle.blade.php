@extends('layouts.plantilla')
@section('title','Restaurantes')
@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection
@section('body')
    <div>
        <div class="container py-8">
            <h1 class="font-bold">{{$lugar->nombre}}</h1>

            <div class="grid grid-cols-3 gap-14">

                {{-- Contenido principal --}}

                <div class="col-span-2">
                    <div>
                        <img class="w-full h-80 object-cover object-center" src="{{Storage::url($lugar->imagen)}}" alt="Detalle del lugar">
                    </div>

                    <div class="text-base mt-4">
                        {!!$lugar->contenido!!}
                    </div>
                </div>

                {{-- Contenido relacionado --}}

                <aside>
                    <h1 class="text-center text-2xl font-bold text-gray-600 mb-4">Más lugares turísticos</h1>

                    <ul>
                        @foreach ($similares as $similar)
                            <li class="mb-4">
                                <a class="flex" href="{{route('lugaresTuristicos.show',$similar)}}">
                                    <img class="w-36 h-20 object-cover object-center" src="{{Storage::url($similar->imagen)}}" alt="">
                                    <span class="ml-10">{{$similar->nombre}}</span>
                                </a>
                            </li>
                            
                        @endforeach
                    </ul>
                </aside>

            </div>
        </div>
    </div>
@endsection
@section('js')