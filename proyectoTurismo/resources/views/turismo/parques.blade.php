@extends('layouts.plantilla')
@section('title','Parques')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection
@section('body')

<div align="center">
    <div class="contenido-turismo">
        @foreach ($parques as $lugar)

            <article class="card" style="width: 18rem;">
                <img src="{{Storage::url($lugar->imagen)}}" class="card-img-top" alt="Parque">
                <div class="card-body">
                    <h5 class="card-title">{{$lugar->nombre}}</h5>
                    <p class="card-text">{!!$lugar->descripcion!!}</p>
                    <a href="{{route('lugaresTuristicos.show', $lugar)}}" class="btn btn-primary">Ver más</a>
                </div>
            </article>   
        @endforeach
        <div class="turismo-paginacion">
            {{$parques->links()}}
        </div>
    </div>

    
</div>
@endsection
@section('js')