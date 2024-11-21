<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;
use Shuchkin\SimpleXLSXGen;


class ProductController extends Controller
{
    // Get a list of products
    public function viewProductsList()
    {
        $products = Product::select(['id', 'slug', 'name', 'price', 'total_quantity', 'sold_quantity', 'available_quantity', 'created_by'])
        ->with("createdBy:id,name,email")
        ->orderBy('id', 'desc')
        ->paginate(8);

        // return $products;

        return view('products', compact('products'));
    }


    // export products as PDF
    public function exportProductsAsPdf()
    {
        $products = Product::select(['id', 'slug', 'name', 'price', 'total_quantity', 'sold_quantity', 'available_quantity', 'created_at'])
            ->orderBy('id', 'desc')
            ->get();

        $data = [
            'title' => 'Products',
            'date' => date('Y-m-d h:i:sA'),
            'products' => $products,
        ];

        $dompdf = new Dompdf();

        // Load HTML content from a blade view
        $html = view('export.pdf.products', $data)->render();

        // Set options (optional)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Apply the options
        $dompdf->setOptions($options);

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();

        // Generate a unique file name for the PDF
        $folderDirection = 'uploads/pdf/';
        $fileName = 'products_list_' . now()->format('YmdHis') . '.pdf';
        $filePath = "$folderDirection/$fileName";

        
        // Save the file to the desired location
        Storage::disk('public')->put($folderDirection . $fileName, $dompdf->output());


        $file_path = Storage::url($folderDirection . $fileName);
        

        $exist = Storage::disk('public')->exists($folderDirection . $fileName);


        if ($exist) {
            // Download file
            return response()->download(storage_path("app/public/$filePath"), $fileName, [
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ])->deleteFileAfterSend(true);
        }
    }


    // export products as CSV
    public function exportProductsAsCSV()
    {
        $products = Product::select(['id', 'slug', 'name', 'price', 'total_quantity', 'sold_quantity', 'available_quantity'])
            ->orderBy('id', 'desc')
            ->get();

        // Define the directory and file path
        $directory = 'uploads/csv';
        $fileName = "products_list_" . now()->format('YmdHis') . ".csv";
        $filePath = "$directory/$fileName";

        // Create directory if it doesn't exist
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Open a temporary file in memory
        $csvFile = fopen('php://temp', 'w');

        // Write the header row
        fputcsv($csvFile, ['ID', 'Name', 'Price', 'Total Quantity', 'Sold Quantity', 'Available Quantity']);

        // Write the data rows
        foreach ($products as $pr) {
            fputcsv($csvFile, [
                $pr->id,
                $pr->name,
                $pr->price,
                $pr->total_quantity,
                $pr->sold_quantity,
                $pr->available_quantity,
            ]);
        }

        // Rewind the temporary file to the beginning
        rewind($csvFile);

        // Save the file to the storage
        Storage::disk('public')->put($filePath, stream_get_contents($csvFile));

        // Close the temporary file
        fclose($csvFile);


        // Download file and remove it after download
        return response()->download(storage_path("app/public/$filePath"), $fileName, [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->deleteFileAfterSend(true);
    }

    
    // export products as EXCEL
    public function exportProductsAsExcel()
    {
        $products = Product::select(['id', 'slug', 'name', 'price', 'total_quantity', 'sold_quantity', 'available_quantity'])
        ->orderBy('id', 'desc')
        ->get();

        // Prepare data array for export
        $data = [
            ['ID', "Name", "Price", "Total quantity", "Sold quantity", "Available quantity"] // Header row
        ];

        foreach ($products as $pr) {
            $row = [
                $pr->id,
                $pr->name,
                $pr->price,
                $pr->total_quantity,
                $pr->sold_quantity,
                $pr->available_quantity,
            ];

            $data[] = $row;
        }

        $xlsx = SimpleXLSXGen::fromArray($data);


        // set path and generate file name
        $directory = 'uploads/excel';
        $fileName = "products_list_" . now()->format('YmdHis') . ".xlsx";
        $filePath = "$directory/$fileName";


        // Storage::disk('public')->makeDirectory($directory);
        Storage::disk('public')->put($filePath, $xlsx);


        // Download file and remove it after download
        return response()->download(storage_path("app/public/$filePath"), $fileName, [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->deleteFileAfterSend(true);
    }
}
