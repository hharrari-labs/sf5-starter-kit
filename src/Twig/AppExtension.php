<?php

namespace App\Twig;

use App\Entity\Contact;
use App\Entity\Nav;
use App\Entity\NavLink;
use App\Entity\SubNav;
use App\Entity\User;
use App\Handler\ContactHandler;
use App\Repository\HomePageRepository;
use App\Repository\ModuleRepository;
use App\Repository\NavRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(
        RequestStack $requestStack, 
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->request = $requestStack->getCurrentRequest();
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('icon_from_bool', [$this, 'iconFromBoolean']),
        ];
    }

    function getFilters()
    {
        return [
            new TwigFilter('role', [$this, 'printRole'])
        ];
    }

    /**
     * Return an HTML icon form boolean value
     *
     * @param string $bool
     * @return Markup
     */
    public function iconFromBoolean(string $bool): Markup
    {
        $bool = (int) $bool;

        if ($bool === 1) return $this->renderAsHtml('<span class="status-icon check-icon"><i class="far fa-check-circle" aria-hidden="true"></i></span>');
        else return $this->renderAsHtml('<span class="status-icon cross-icon"><i class="far fa-times-circle" aria-hidden="true"></i></span>');
    }
    
    /**
     * @param array $array
     * @return string
     */
    public function printRole(array $array): string
    {
        if (in_array(User::ADMIN, $array)) return "Administrateur";
        else return "Utilisateur";
    }

    /**
     * Return as HTML element
     *
     * @return Markup
     */
    private function renderAsHtml(string $data): Markup
    {
        return new Markup($data, "UTF-8");
    }
}