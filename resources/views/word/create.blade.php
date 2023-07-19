@extends('layouts.app')

@section('content')
	
	<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">


			<form action="/word" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" class="border border-gray-300 rounded-md p-2 w-full" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-bold mb-2">Message:</label>
                    <textarea id="message" name="message" rows="4" class="border border-gray-300 rounded-md p-2 w-full" required></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                </div>
        	</form>


        </div>
      </div>
    </div>
  </div>

@endsection