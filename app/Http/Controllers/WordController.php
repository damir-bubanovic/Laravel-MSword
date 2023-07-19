<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Word;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\SimpleType\Jc;
use Illuminate\Support\Str;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('word.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        // Get the form data
        $name = $request->input('name');
        $message = $request->input('message');

        // Create a new PhpWord instance
        $phpWord = new PhpWord();

        // Add a section to the document
        $section = $phpWord->addSection();



        // Set the logo
        $section->addTextBreak(1);
        $logoPath = public_path('images/logo-word.png');
        $section->addImage($logoPath, [
            'width' => 200,
            'height' => 100,
            'alignment' => 'center',
        ]);


        // Add the title
        $section->addTextBreak(1);
        $titleParagraph = $section->addTextRun([
            'alignment' => Jc::CENTER,
        ]);
        $titleParagraph->addText('Justice Report v.22', [
            'name' => 'Arial',
            'size' => 24,
            'bold' => true,
        ]);



        // Add the current date
        $section->addTextBreak(2);
        $dateParagraph = $section->addTextRun([
            'alignment' => Jc::RIGHT,
        ]);
        $date = now()->format('F j, Y');
        $dateParagraph->addText('Date: ' . $date, [
            'name' => 'Arial',
            'size' => 12,
        ]);


        // Add content to the section
        $section->addTextBreak(5);
        $textRun = $section->addTextRun([
            'alignment' => Jc::LEFT,
        ]);
        $textRun->addText('Name: ', [
            'name' => 'Arial',
            'size' => 12,
            'bold' => true,
        ]);
        $textRun->addText($name, [
            'name' => 'Arial',
            'size' => 12,
        ]);
        $section->addTextBreak(1);


        $textRun = $section->addTextRun([
            'alignment' => Jc::LEFT,
        ]);
        $textRun->addText('Message: ', [
            'name' => 'Arial',
            'size' => 12,
            'bold' => true,
        ]);
        $textRun->addText($message, [
            'name' => 'Arial',
            'size' => 12,
        ]);


        // Set font styling for the filler text
        $section->addTextBreak(2);
        $section->addText('Some generic text: ', [
            'name' => 'Arial',
            'size' => 12,
            'bold' => true,
        ]);
        $generic = $section->addTextRun([
            'indentation' => ['left' => 480], // 480 twips (1 cm) of indentation, adjust as needed
        ]);
        $generic->addText('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum. Lectus nulla at volutpat diam ut venenatis tellus in metus. Pellentesque dignissim enim sit amet venenatis urna. Tincidunt tortor aliquam nulla facilisi cras fermentum. Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus. Purus viverra accumsan in nisl. Ullamcorper sit amet risus nullam. Tincidunt id aliquet risus feugiat. Volutpat est velit egestas dui id ornare arcu odio ut. Netus et malesuada fames ac turpis egestas maecenas pharetra convallis. In ornare quam viverra orci sagittis eu volutpat odio. Mi in nulla posuere sollicitudin aliquam ultrices sagittis. Interdum velit euismod in pellentesque massa placerat duis ultricies lacus. Sit amet nisl purus in mollis nunc sed id. Quisque id diam vel quam elementum pulvinar. Bibendum est ultricies integer quis. Lorem mollis aliquam ut porttitor. Aenean sed adipiscing diam donec adipiscing tristique. Viverra maecenas accumsan lacus vel facilisis volutpat est.');

        
        // Add a place to sign
        $section->addTextBreak(4); // Add some space between the text and the signature line
        $section->addText('__________________________', [
            'name' => 'Arial',
            'size' => 12,
            'alignment' => Jc::RIGHT,
        ]);
        $section->addText($name, [
            'name' => 'Arial',
            'size' => 12,
            'alignment' => Jc::RIGHT,
            'bold' => true,
        ]);


        // Save the document as a Word file
        $uniqueId = Str::uuid()->toString();
        $filename = 'Word' . '_' . $uniqueId . '.docx';
        $filepath = storage_path($filename);

        $phpWord->save($filepath);

        // Generate a downloadable response
        return response()->download($filepath, $filename)->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        //
    }
}
