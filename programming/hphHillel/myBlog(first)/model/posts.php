<?php

    class Post {
        private $storageLink = '/var/www/html/my_blog_project/myBlog(first)/model/db.txt';

        public function __construct()
        {
            if (!$this->dbExists()) {
                $this->createDb();
            }
        }

        private function dbExists() {
            return file_exists($this->storageLink);
        }

        private function createDb() {
            $posts = $this->generatePosts();
            $str = serialize($posts);

            file_put_contents($this->storageLink, $str);
        }

        private function generatePosts($number = 5) {
            $posts = [];

            for ($i = 0; $i < $number; $i++) {
                $posts[] = [
                    'title' => 'title' . ($i+1),
                    'body' => 'body',
                    'author' => 'admin',
                ];
            }
            return $posts;
        }

        public function getPosts() {
            return unserialize(file_get_contents($this->storageLink));
        }

        public function getPost($id) {
            $posts = $this->getPosts();
            return $posts[$id];
        }

    }