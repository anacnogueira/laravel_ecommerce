<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\BannerService;
use App\Services\CategoryService;
use App\Services\ReportSearchService;
use App\Http\Requests\ProductSearchRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $bannerService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        BannerService $bannerService,
        CategoryService $categoryService,
        ReportSearchService $reportSearchService,
    )
    {
        $this->productService = $productService;
        $this->bannerService = $bannerService;
        $this->categoryService = $categoryService;
        $this->reportSearchService = $reportSearchService;
    }

    public function index()
    {
        $products = $this->productService->getAllHighlightProducts();
        $banners = $this->bannerService->getActiveBanners();
        $title = 'Catálogo de Produtos';

        foreach ($products as $i => $product) {
            //$products[$i]['Promotion'] = $this->Product->ProductPromotion->getPromotion($product);
            $products[$i]->categories = $product->category->ancestors($product->category_id);
          }

        return view('products.index', compact('products','banners','title'));

    }

    public function show($categoriesAndSlug)
    {
        $segments = explode('/', $categoriesAndSlug);
        $permalink = array_pop($segments);
        $comments = [];
        $url = "https://mayacosmeticos.com.br/item/{$categoriesAndSlug}";

        $product = $this->productService->getProductByPermalink($permalink);
        $product->categories = $product->category->ancestors($product->category_id);
        $product->price = count($product->promotions) > 0 ? $product->promotions[0]->price_promotion : $product->selling_price;
        $availability =  ($product->status == "S" && $product->current_stock > 0) ?  "InStock" : "OutOfStock";

        for($i = 0; $i < count($product->photos); $i++) {
             $photo  = $product->photos[$i];
             $images[] =  '"'.str_replace('http:','https:', env('SITE_URL')). $photo->photo_ori . '"';
        }

        $schema = [
            "@context" => "http://schema.org/",
            "@type" => "Product",
            "name" => "$product->name}",
            "image" => [ $images ],
            "description" => "$product->description",
            "sku" => "$product->code",
            "brand" => [
                "@type" => "Brand",
                "name" => "{$product->brand->name}"
            ],
            "review" => [
                "@type"=> "Review",
                "reviewRating"=>[
                    "@type" => "Rating",
                    "ratingValue" => "4",
                    "bestRating" => "5"
                ],
                "author" => [
                    "@type" => "Person",
                    "name" => "Ana Claudia Nogueira"
                ]
            ],
            "aggregateRating" => [
                "@type" => "AggregateRating",
                "ratingValue" => "4.4",
                "reviewCount" => "10"
            ],
            "offers" => [
                "@type" => "Offer",
                "url" => "$url",
                "priceCurrency" => "BRL",
                "price" => "$product->price",
                "priceValidUntil" => "2030-01-01",
                "itemCondition"=> "http://schema.org/NewCondition",
                "availability" => "http://schema.org/{$availability}",
                "seller" => [
                    "@type" => "Organization",
                    "name" => "Maya Cosméticos"
                ]
            ]
        ];

        return view('products.show', compact('segments', 'product','categoriesAndSlug','comments', 'schema'));
    }

    public function search(ProductSearchRequest $request)
    {
        $keyword = $request->input("keyword");

        if (isset($keyword)) {

            $data = [
                'keyword' => $keyword,
                'type' => 'search',
                'ip' => '',
            ];

            $this->reportSearchService->makeReportSearch($data);

            return redirect()->route('products.result', $keyword);
        }
    }

    public function result($keyword)
    {
        $title = "Resultado da Busca - ".$keyword;

        $products = $this->productService->getProductsByKeyword($keyword);

        return view('products.result', compact('products','title', 'keyword'));

    }

    public function categories($permalink)
    {
        $title = '';
        $category = $this->categoryService->getCategoryByPermalink($permalink);
        $ancestors = $category->ancestors($category->id);

        for ($i = 0; $i < $ancestors->count(); $i++) {
            $title .=  $ancestors[$i]->name . " » ";
        }

        $title .= $category->name;

        $categories = $this->categoryService->getChildrenCategories($category->id);

        $products = $this->productService->getProductsInCategories($categories);

        return view('products.categories', compact('category','title', 'permalink', 'ancestors', 'products'));
    }

    public function news()
    {
        $title = 'Novidades';

        $products = $this->productService->getProductsByNews();

        return view('products.news', compact('title', 'products'));
    }

}
