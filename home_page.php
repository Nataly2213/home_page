<?php
$app->get(
    '/blog[/{page}]', 
    function (Request $request, Response $response, $args) 
        use ($view, $connection) {
        $latestPosts = new PostMapper($connection);
    
        $page = isset($args['page']) ? (int) $args['page'] : 1;
        $limit = 2;
    
        $posts = $latestPosts->getList($page, $limit, 'DESC');
    
        $body = $view->render(
            'blog.twig', 
            ['posts' => $posts]
        );
        $response->getBody()->write($body);
        return $response;
    }
);
