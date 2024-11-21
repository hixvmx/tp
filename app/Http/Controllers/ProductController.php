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
    
    // view 'product/add' page
    public function viewProductAddPage()
    {
        return view('add_new_product');
    }
    
    
    // view 'product/add' page
    public function viewEditProductPage(int $id)
    {
        $product = [];
        if (!empty($id)) {
            $product = Product::where('id', $id)->first();
        }

        if (!$product) {
            return back();
        }

        return view('edit_product', compact('product'));
    }

    
    // save changes
    public function updateProductInfo(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'total_quantity' => 'required|integer|min:1',
            'sold_quantity' => 'required|integer|min:1',
            'available_quantity' => 'required|integer|min:1',
        ]);

        
        $product = Product::where('id', $request->id)->first();
        if (!$product) {
            return back();
        }

        
        // update
        $product->name = $request->name;
        $product->price = $request->price;
        $product->total_quantity = $request->total_quantity;
        $product->sold_quantity = $request->sold_quantity;
        $product->available_quantity = $request->available_quantity;
        $product->save();


        // Redirect back with a success message
        return redirect('/');
    }
    

    // save new product
    public function saveNewProduct(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_quantity' => 'required|integer|min:1',
            'product_price' => 'required|integer|min:1',
        ]);

        // Save the product to the database
        Product::create([
            'name' => $validated['product_name'],
            'price' => '$'.$validated['product_price'],
            'total_quantity' => $validated['product_quantity'],
            'sold_quantity' => 0,
            'available_quantity' => 0,
            'created_by' => 1,
        ]);

        // send notification to other admins
        $this->newNotification('added a new product with ID:'.$id.'.');

        // Redirect back with a success message
        return redirect('/');
    }
    
    
    // delete product
    public function deleteProductById(Request $request, int $id)
    {
        if (!empty($id)) {
            Product::where('id', $id)->delete();

            // send notification to other admins
            $this->newNotification('has removed the product with ID:'.$id.'.');
        }

        return redirect('/');
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

            // send notification to other admins
            $this->newNotification('exported the products list as a pdf.');

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


        // send notification to other admins
        $this->newNotification('exported the products list as a csv.');


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


        // send notification to other admins
        $this->newNotification('exported the products list as a excel.');


        // Download file and remove it after download
        return response()->download(storage_path("app/public/$filePath"), $fileName, [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->deleteFileAfterSend(true);
    }
}
