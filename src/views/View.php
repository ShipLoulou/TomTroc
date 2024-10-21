<?php

class View
{
    /**
     * Le titre de la page.
     */
    private string $title;
    private string $description;
    private string $mainClass;


    /**
     * Constructeur.
     */
    public function __construct($title, $description, $mainClass)
    {
        $this->title = $title;
        $this->description = $description;
        $this->mainClass = $mainClass;
    }

    /**
     * Cette méthode retourne une page complète.
     * @param string $viewPath : le chemin de la vue demandée par le controlleur.
     * @param array $params : les paramètres que le controlleur a envoyé à la vue.
     * @return string
     */
    public function render(string $viewName, array $params = []): void
    {
        // On s'occupe de la vue envoyée
        $viewPath = $this->buildViewPath($viewName);

        // Les trois variables ci-dessous sont utilisées dans le "main.php" qui est le template principal.
        $content = $this->_renderViewFromTemplate($viewPath, $params);
        $title = $this->title;
        $description = $this->description;
        $mainClass = $this->mainClass;
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }

    /**
     * Coeur de la classe, c'est ici qu'est généré ce que le controlleur a demandé.
     * @param $viewPath : le chemin de la vue demandée par le controlleur.
     * @param array $params : les paramètres que le controlleur a envoyés à la vue.
     * @throws Exception : si la vue n'existe pas.
     * @return string : le contenu de la vue.
     */
    private function _renderViewFromTemplate(string $viewPath, array $params = []): string
    {
        if (file_exists($viewPath)) {
            extract($params); // On transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }


    /**
     * Cette méthode construit le chemin vers la vue demandée.
     * @param string $viewName : le nom de la vue demandée.
     * @return string : le chemin vers la vue demandée.
     */
    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}
