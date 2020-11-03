<?php
// TODO Move to : UserController, ArticleController, CommentController ?
namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function administration()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('administration', [
            'articles' => $articles
        ]);
    }

    public function addArticle(Parameter $post)
    {
        // The form is submitted.
        if ($post->get('submit')) {
            // Without error.
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->articleDAO->addArticle($post, $this->session->get('id'));
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php?route=administration');
            }
            // With some errors.
            return $this->view->render('add_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }

        // the form is displayed.
        return $this->view->render('add_article');
    }

    public function editArticle(Parameter $post, $articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        // The form is submitted.
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            // Without error.
            if (!$errors) {
                $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                $this->session->set('edit_article', 'L\' article a bien été modifié');
                header('Location: ../public/index.php?route=administration');
            }
            // With some errors.
            return $this->view->render('edit_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }

        // the form is displayed, set default form values.
        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->view->render('edit_article', [
            'post' => $post
        ]);
    }

    public function deleteArticle($articleId)
    {
        $this->articleDAO->deleteArticle($articleId);
        $this->session->set('delete_article', 'L\' article a bien été supprimé');
        header('Location: ../public/index.php?route=administration');
    }

    public function deleteComment($commentId)
    {
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
        header('Location: ../public/index.php');
    }

    public function profile()
    {
        return $this->view->render('profile');
    }

    public function updatePassword(Parameter $post)
    {
        if ($post->get('submit')) {
            $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Le mot de passe a été mis à jour');
            header('Location: ../public/index.php?route=profile');
        }
        return $this->view->render('update_password');
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'À bientôt');
        header('Location: ../public/index.php');
    }

    public function deleteAccount()
    {
        $this->userDAO->deleteAccount($this->session->get('pseudo'));
        $this->session->stop();
        $this->session->start();
        $this->session->set('delete_account', 'Votre compte a bien été supprimé');
        header('Location: ../public/index.php');
    }
}
