@extends('layouts.main')

@section('title', 'contatos')

@section('content')


<H3>Área de contatos</H3>

<p>Lista de alunos do Marista Jaime BIAZUS</p>

@foreach($alunos as $nomes)
<p>{{$nomes}}</p>

@endforeach



<a href="/">Voltar a home</a>

@endsection