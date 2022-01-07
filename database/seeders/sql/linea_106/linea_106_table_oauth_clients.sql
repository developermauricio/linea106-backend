
--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'nC6pGY99xCHAKGDs1sr83QDejt0SXoSzjXEHo4oc', NULL, 'http://localhost', 1, 0, 0, '2021-12-28 22:47:06', '2021-12-28 22:47:06'),
(2, NULL, 'Laravel Password Grant Client', '2SEm3hPNoATcAJcFrr14OngcrD8JysmoLKjUhnLM', 'users', 'http://localhost', 0, 1, 0, '2021-12-28 22:47:06', '2021-12-28 22:47:06');
