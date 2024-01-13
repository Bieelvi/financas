<?php 

namespace Financas\Controller;

use Financas\Entity\Product;
use Financas\Helper\{FlashMessage, RenderHtml, Response, Route};

class ProductController extends Controller
{
    public function view(): void
    {
        if (!$_SESSION['logged']->isAdmin()) {
            Route::redirect('home');
        }

        $products = $this->em
            ->getRepository(Product::class)
            ->findAll();

        RenderHtml::render(
            'Product/Index.php', [
                'title' => translate('Products'),
                'products' => $products
            ]
        );
    }

    public function store(): void
    {
        if (!$_SESSION['logged']->isAdmin()) {
            Route::redirect('home');
        }

        $post = $this->post();

        try {
            $product = new Product();
            $product->setName($post['product-name']);

            $this->em->persist($product);
            $this->em->flush();

            FlashMessage::message(
                'success', 
                translate('Product saved with successfully')
            );

            Route::redirect('products');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );

            RenderHtml::render(
                'Product/Index.php', [
                    'title' => translate('Products'),
                ]
            );
        }
    }

    public function delete(): void
    {
        if (!$_SESSION['logged']->isAdmin()) {
            Route::redirect('home');
        }

        $post = $this->post();

        try {
            $product = $this->em
                ->getRepository(Product::class)
                ->find($post['id']);
                
            $this->em->remove($product);
            $this->em->flush();
            
            Response::json([
                'data' => translate('Product deleted with successfully')
            ], 200);
        } catch (\Throwable $e) {
            Response::json([
                'data' => $e->getMessage()
            ], 404);
        }
    }
}