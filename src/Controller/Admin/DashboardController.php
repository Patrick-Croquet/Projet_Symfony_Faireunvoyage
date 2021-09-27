<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Order;
use App\Entity\Header;
use App\Entity\Carrier;
use App\Entity\Product;
use App\Entity\Category;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    
    protected $userRepository;
    protected $orderRepository;

    public function __construct(
        UserRepository $userRepository,
        OrderRepository $orderRepository
    )
    {
       $this->userRepository = $userRepository; 
       $this->orderRepository = $orderRepository;
    }
    /**
     * @Route("/admin_193ar150", name="admin")
     */
    public function index(): Response
    {
        return $this->render('@EasyAdmin/welcome.html.twig', [
            'countUser' => $this->userRepository->countAllUser(),
            'countOrder' => $this->orderRepository->countAllOrder()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DoDo Le Guide');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->displayUserName(true)
            //->setAvatarUrl('https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png')
            //->setAvatarUrl($user->getProfileImageUrl())
            ->displayUserAvatar(true)
            ->setGravatarEmail($user->getUsername());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-tags', User::class);
        yield MenuItem::linkToCrud('Orders', 'fa fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list-ul', Category::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-barcode', Product::class);
        yield MenuItem::linkToCrud('Carriers', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('Headers', 'fas fa-tv', Header::class);
    }
}
