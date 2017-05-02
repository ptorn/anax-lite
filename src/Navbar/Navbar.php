<?php
namespace Peto16\Navbar;

/**
 * Navbar class.
 *
 */
class Navbar implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;



    /**
     * Check if item matches current route
     * @method isActiveLink
     * @param  [array]       $item [array item from navbar config]
     * @return string            [result with class name for active]
     */
    private function isActiveLink($item)
    {
        $currentUrl = $this->app->request->getRoute();
        if ($currentUrl === $item["route"]) {
            return ' class="active"';
        }
    }



    /**
     * Function to generate list items för the navbar with unlimited submenus.
     * @method generateNavbarList
     * @param  [Array]             $items [navbar links]
     * @return [html list-items]                    [li-items in html]
     */
    public function generateNavbarList($items, $class = false, $order = 1)
    {
        $output = $class ? "<ul class=\"" . $class . "\">" : "<ul>";
        foreach ($items as $item) {
            if ($item['route'] == "login") {
                if ($this->app->session->get('user')) {
                    $item['route'] = "administration/user";
                    $item['text'] = "User";
                }
            }

            $output .= '<li' . $this->isActiveLink($item) . '><a href="' . $this->app->url->create($item["route"]) .
                       '" title="' . $item['text'] . '">' . $item['text'] . '</a>';
            if (isset($item['submenu']) && is_array($item['submenu'])) {
                $output .= $this->generateNavbarList($item['submenu']['items'], $order + 1);
            }
            $output .= '</li>' . "\n";
        }
        $output .= "</ul>";
        return $output;
    }



    /**
     * Generate the HTML for the navbar.
     * @method generateNavbarHTML
     * @param  string             $class The preferd CSS class.
     * @return string                    Navbar in HTML.
     */
    public function generateNavbarHTML($class)
    {
        $items = $this->config["items"];
        return $this->generateNavbarList($items, $class);
    }
}
