<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Keyword;
use App\Models\News;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Dompdf\Options;
use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;
use Mpdf\MpdfException;
// use PDF;

use Illuminate\Support\Facades\Log;



class HomeController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Fetch all categories
    //     $categories = Category::all();

    //     // Fetch all keywords and group them by category
    //     $keywordsByCategory = Keyword::all()->groupBy('category_id');

    //     // Calculate yesterday's and today's dates
    //     $yesterday = \Carbon\Carbon::yesterday()->format('Y-m-d');
    //     $today = \Carbon\Carbon::today()->format('Y-m-d');

    //     return view('admin.dashboard', compact('keywordsByCategory', 'categories', 'yesterday', 'today'));
    // }



    //----------index-----------

    // public function index(Request $request)
    // {
    //     // Fetch all categories
    //     $categories = Category::all();

    //     // Fetch all keywords
    //     $allKeywords = Keyword::all();

    //     // Calculate yesterday's and today's dates
    //     $yesterday = \Carbon\Carbon::yesterday()->format('Y-m-d');
    //     $today = \Carbon\Carbon::today()->format('Y-m-d');

    //     return view('admin.dashboard', compact('categories', 'allKeywords', 'yesterday', 'today'));
    // }



    //-------------getKeywordsByCategory-----------------

    // public function getKeywordsByCategory($category_id)
    // {
    //     // Get keywords for the selected category
    //     $keywords = Keyword::where('category_id', $category_id)->get();

    //     // Return as JSON response
    //     return response()->json($keywords);
    // }



    //------------------store---------------

    // public function store(Request $request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'keyword' => 'nullable|array|min:1',
    //         'keyword.*' => 'string',
    //         'when' => 'nullable|numeric',
    //         'from_date' => 'nullable|date_format:Y-m-d',
    //         'to_date' => 'nullable|date_format:Y-m-d',
    //     ]);

    //     // Process 'when' input
    //     $when = $request->when ? $request->when . 'h' : null;

    //     // Format keywords for the API request
    //     $keywords = $request->keyword ? implode(' OR ', $request->keyword) : '';

    //     try {
    //         // Send API request with retries and timeout
    //         $response = Http::retry(3, 100) // 3 attempts with 100ms delay
    //             ->timeout(60) // 60 seconds timeout
    //             ->post('http://115.127.99.114:5522/success', [
    //                 'keyword' => $keywords,
    //                 'when' => $when,
    //                 'from_date' => $request->from_date,
    //                 'to_date' => $request->to_date,
    //             ]);

    //         // http://192.168.20.33:5512/success

    //         // Check if the request failed
    //         if ($response->failed()) {
    //             return redirect()->back()->withErrors(['error' => 'Failed to fetch news from API.']);
    //         }

    //         // Extract news data from the response
    //         $news = $response->json();

    //         // Ensure news data exists
    //         if (empty($news)) {
    //             return redirect()->back()->withErrors(['error' => 'No news found for the given parameters.']);
    //         }

    //         // Render view with the news data
    //         return view('admin.news.index', compact('news'));
    //     } catch (RequestException $e) {
    //         // Handle network or timeout exceptions
    //         return redirect()->back()->withErrors([
    //             'error' => 'The request timed out or failed. Please try again later.',
    //         ]);
    //     }
    // }


    //-------------------update---------------------

    // public function showUpdateCatPage(Request $request)
    // {
    //     $categories = $request->input('categories', []);
    //     $date = $request->input('date');

    //     $query = News::query();

    //     // Show only news with empty or null category
    //     $query->where(function ($q) {
    //         $q->whereNull('category')
    //             ->orWhere('category', '')
    //             ->orWhere('category', '[]') // If category is stored as JSON array
    //             ->orWhere('category', 'like', '[]'); // Additional check for JSON string
    //     });

    //     if (!empty($date)) {
    //         $query->whereDate('saved_date', $date);
    //     }

    //     $news = $query->get();

    //     return view('admin.news.update_category', compact('news'));
    // }

    //-----------------updateTitle----------

    // public function updateTitle(Request $request, $id)
    // {

    //     $news = News::findOrFail($id);
    //     $news->title = $request->title;
    //     $news->save();

    //     return response()->json(['success' => true]);
    // }

    // public function updateCategories(Request $request)
    // {
    //     $selectedNews = $request->input('news', []);

    //     foreach ($selectedNews as $newsItem) {
    //         if (isset($newsItem['selected']) && $newsItem['selected']) {
    //             $id = $newsItem['id'];
    //             $categories = $newsItem['categories'] ?? [];

    //             // Update the news categories in the database
    //             News::where('id', $id)->update([
    //                 'category' => implode(',', $categories)
    //             ]);
    //         }
    //     }

    //     return redirect()->route('news.list')
    //         ->with('success', 'Categories updated successfully for selected news.');
    // }


    //----------------updateSource---------------

    // public function updateSource(Request $request, $id)
    // {
    //     $news = News::findOrFail($id);
    //     $news->source_name = $request->source_name;
    //     $news->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Source name updated successfully'
    //     ]);
    // }

    //---------------reorder-----------------

    // public function reorder(Request $request)
    // {
    //     try {
    //         $order = $request->input('order');
    //         foreach ($order as $index => $newsId) {
    //             News::where('id', $newsId)->update(['order' => $index + 1]);
    //         }
    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()]);
    //     }
    // }


    //-------------destroy---------------

    // public function destroy($id)
    // {
    //     try {
    //         $news = News::findOrFail($id);
    //         $news->delete();

    //         return redirect()
    //             ->back()
    //             ->with('success');
    //     } catch (\Exception $e) {
    //         Log::error('Error deleting news: ' . $e->getMessage());

    //         return redirect()
    //             ->back()
    //             ->with('error', 'Failed to delete news');
    //     }
    // }


    //--------------------------------store all------------

    // public function store_all(Request $request)
    // {
    //     try {
    //         // If no specific keywords are provided, fetch all keywords
    //         if (!$request->has('keyword')) {
    //             $keywords = Keyword::pluck('name')->toArray();
    //         } else {
    //             $keywords = explode(',', $request->keyword);
    //         }

    //         // Ensure keywords exist
    //         if (empty($keywords)) {
    //             return redirect()->back()->withErrors(['error' => 'No keywords available for the request.']);
    //         }

    //         // Format keywords for the API request
    //         $keywordsString = implode(' OR ', $keywords);

    //         // Get the date range
    //         $toDateTime = now()->format('Y-m-d') . ' 08:00:00';
    //         $fromDateTime = now()->subDay()->format('Y-m-d') . ' 08:00:00';

    //         // Make the API request
    //         $response = Http::retry(3, 100)
    //             ->timeout(60)
    //             ->post('http://115.127.99.114:5522/success', [
    //                 'keyword' => $keywordsString,
    //                 'from_date' => now()->subDay()->format('Y-m-d'),
    //                 'to_date' => now()->format('Y-m-d'),
    //                 'from_time' => '08:00:00',
    //                 'to_time' => '08:00:00'
    //             ]);

    //         if (!$response->successful()) {
    //             return redirect()->back()->withErrors(['error' => 'Failed to fetch news from API.']);
    //         }

    //         $news = $response->json();

    //         // Filter news based on timestamp
    //         $filteredNews = array_filter($news, function ($article) use ($fromDateTime, $toDateTime) {
    //             $articleDateTime = Carbon::parse($article['Published DateTime']);
    //             $startDateTime = Carbon::parse($fromDateTime);
    //             $endDateTime = Carbon::parse($toDateTime);

    //             return $articleDateTime->greaterThanOrEqualTo($startDateTime) &&
    //                 $articleDateTime->lessThanOrEqualTo($endDateTime);
    //         });

    //         if (empty($filteredNews)) {
    //             return redirect()->back()->withErrors(['error' => 'No news found for the given time period.']);
    //         }

    //         // // Generate PDF
    //         // $pdf = PDF::loadView('admin.news-pdf', compact('filteredNews'));

    //         // // Stream or download the PDF
    //         // return $pdf->stream('news_report.pdf');
    //         return view('admin.news.index', ['news' => array_values($filteredNews)]);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors([
    //             'error' => 'An error occurred: ' . $e->getMessage()
    //         ]);
    //     }
    // }



    //------------save-------------------


    public function save(Request $request)
    {
        $selectedNews = $request->input('news', []);

        foreach ($selectedNews as $newsItem) {
            if (isset($newsItem['selected']) && $newsItem['selected']) {
                $newsData = json_decode($newsItem['data'], true);
                $categories = $newsItem['categories'] ?? [];
                // dd( $categories);

                $publishedDate = Carbon::parse($newsData['Published Date']);
                $today = Carbon::today();

                // Determine the saved_date based on the condition
                if ($publishedDate->isToday()) {
                    $savedDate = $today;
                } else {
                    $savedDate = $publishedDate;
                }

                if ($newsData) {
                    // Save the news data to the database
                    News::create([
                        'title' => $newsData['News Title'],
                        'url' => $newsData['News URL'],
                        'published_date' => $newsData['Published Date'],
                        'source_name' => $newsData['Newspaper Name/Source Name'],
                        'category' => implode(',', $categories), // Save categories as a comma-separated string
                        'saved_date' => $savedDate,
                    ]);
                }
            }
        }

        return redirect()->route('news.update_category')->with('success', 'Selected news saved successfully.');
    }


    //-----------------------------------------------------------------------

    public function news_Pdf($url)
    {
        // dd($url);
        $response = Http::post('https://newsapi-1.onrender.com/news_html', [
            'url' => $url,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Get the HTML content from the response
            $htmlContent = $response->body();

            // Decode the Unicode escape sequences to UTF-8
            $htmlContent = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($matches) {
                return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UCS-2BE');
            }, $htmlContent);

            // Add custom font using inline CSS in HTML content
            $htmlContent = '<style>
                @font-face {
                    font-family: "my_custom_name";
                    src: url("fonts/SolaimanLipi.ttf") format("truetype");
                    font-weight: normal;
                    font-style: normal;
                }
                body {
                    font-family: "my_custom_name", Arial, sans-serif !important;
                }
            </style>' . $htmlContent;

            // Initialize dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            // Load the HTML content
            $dompdf->loadHtml($htmlContent);

            // Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to browser
            $dompdf->stream('document.pdf', ['Attachment' => 0]);
        } else {
            // Handle the error
            echo "Error: " . $response->status();
        }
    }

    //------------------------------------------------------------------------------





    //----------------list-----------------

    public function list(Request $request)
    {
        $categories = $request->input('categories', []);
        // dd($categories);// Array of selected categories
        $date = $request->input('date'); // Selected date

        $query = News::query();

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $query->orWhere('category', 'like', '%' . $category . '%');
            }
        }

        if (!empty($date)) {
            $query->whereDate('saved_date', $date);
        }

        $query->orderBy('order', 'asc');

        $news = $query->get();
        // $pdf = $this->generatePDF($news);

        return view('admin.news.list', compact('news'));
    }


    //-------------------generatePDF------------------

    public function generatePDF(Request $request)
    {
        $categories = $request->input('categories', []);
        $date = $request->input('date');

        // Query news based on selected categories and date
        $query = News::query();

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $query->orWhere('category', 'like', '%' . $category . '%');
            }
        }

        if (!empty($date)) {
            $query->whereDate('saved_date', $date);
        }

        $query->orderBy('order', 'asc');

        $news = $query->get();

        // Generate PDF
        $pdf = PDF::loadView('admin.news-pdf', compact('news', 'categories'));

        // Stream or download the PDF
        return $pdf->stream('news_report.pdf');
    }



    //---------------logout-----

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}