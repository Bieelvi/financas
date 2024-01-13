<?php 

namespace Financas\Controller;

use Financas\Entity\Farmer;
use Financas\Entity\Product;
use Financas\Entity\User;
use Financas\Enum\ProductType;
use Financas\Helper\FlashMessage;
use Financas\Helper\RenderHtml;
use Financas\Helper\Response;
use Financas\Helper\Route;

class FarmerController extends Controller
{
    public function view(): void
    {
        $get = $this->get();

        $products = $this->em
            ->getRepository(Product::class)
            ->findAll();
            
        $farmers = $this->em
            ->getRepository(Farmer::class)
            ->findAllWithFilter($get);
        
        RenderHtml::render(
            'Farmer/Index.php', [
                'title'      => translate("Farmer"),
                'products'   => $products,
                'farmers'    => $farmers,
                'params'     => $get
            ]
        );
    }

    public function show(): void
    {
        $get = $this->get();

        $products = $this->em
            ->getRepository(Product::class)
            ->findAll();
        
        $farmer = $this->em
            ->getRepository(Farmer::class)
            ->find($get['id']);
        
        RenderHtml::render(
            'Farmer/Show.php', [
                'title'      => translate("Farmer"),
                'products'   => $products,
                'farmer'     => $farmer,
                'edit'       => true
            ]
        );
    }

    public function edit(): void
    {
        $post = $this->post();

        try {
            /** @var Farmer */
            $farmer = $this->em
                ->getRepository(Farmer::class)
                ->find($post['id']);

            /** @var Product */
            $product = $this->em
                ->getRepository(Product::class)
                ->find($post['product']);  

            $farmer->setProduct($product)
                ->setType($post['product-type'])
                ->setValue($post['product-value'])
                ->setDate(new \DateTimeImmutable($post['product-date']))
                ->setObservation($post['product-observation']);
            
            $this->em->persist($product);
            $this->em->flush();

            FlashMessage::message(
                'success', 
                translate('Farmer edit with successfully')
            );
            
            Route::redirect('farmer');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );

            Route::redirect('farmer');
        }
    }

    public function store(): void
    {
        $post = $this->post();

        try {
            $user = $this->em
                ->getRepository(User::class)
                ->find($_SESSION['logged']->getId());

            $product = $this->em
                ->getRepository(Product::class)
                ->find($post['product']);

            $farmer = new Farmer();
            $farmer->setUser($user)
                ->setProduct($product)
                ->setType(ProductType::from($post['product-type'])->value)
                ->setDate(new \DateTimeImmutable($post['product-date']))
                ->setValue($post['product-value'])
                ->setObservation($post['product-observation']);

            $this->em->persist($farmer);
            $this->em->flush();

            FlashMessage::message(
                'success', 
                translate('Farmer saved with successfully')
            );

            Route::redirect('farmer');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );

            Route::redirect('farmer');
        }
    }

    public function delete(): void
    {
        $post = $this->post();

        try {
            $farmer = $this->em
                ->getRepository(Farmer::class)
                ->find($post['id']);

            $this->em->remove($farmer);
            $this->em->flush();
            
            Response::json([
                'data' => translate('Farmer deleted with successfully')
            ], 200);
        } catch (\Throwable $e) {
            Response::json([
                'data' => $e->getMessage()
            ], 404);
        }
    }
}