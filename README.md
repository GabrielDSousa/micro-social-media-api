# Social Media API

Welcome to the **Social Media API**, a micro social network designed as a modern alternative to traditional forums. This API allows users to create accounts, participate in discussions, and interact with posts through topics and forums.

## Features

- **User Management**: User registration, authentication, and profile customization.
- **Forums**: Create and manage discussion categories.
- **Topics**: Create, view, and manage topics within forums.
- **Posts and Replies**: Add posts and nested replies to topics.
- **Likes and Reports**: Interact with posts by liking or reporting inappropriate content.
- **Moderation Tools**: Manage forums, topics, and review reported posts.

## Tech Stack

- **Backend**: PHP (Laravel 11)
- **Database**: MySQL
- **Authentication**: JWT-based authentication
- **API Documentation**: Scribe

## Installation

1. **Clone the Repository**:
    
    ```
    git clone https://github.com/GabrielDSousa/social-media-api.git
    cd social-media-api
    ```
    
2. **Install Dependencies**:
    
    ```
    composer install
    ```
    
3. **Environment Setup**:
Copy the `.env.example` file and configure the environment variables:
    
    ```
    cp .env.example .env
    ```
    
    Set your database and JWT settings in the `.env` file.
    
4. **Generate Application Key**:
    
    ```
    php artisan key:generate
    ```
    
5. **Run Database Migrations**:
    
    ```
    php artisan migrate
    ```
    
6. **Start the Development Server**:
    
    ```
    php artisan serve
    ```
    

## API Endpoints

### Authentication

- `POST /api/register`: Register a new user.
- `POST /api/login`: Authenticate and receive a JWT.

### Forums

- `GET /api/forums`: List all forums.
- `POST /api/forums`: Create a new forum (admin only).

### Topics

- `GET /api/forums/{forum_id}/topics`: List all topics in a forum.
- `POST /api/forums/{forum_id}/topics`: Create a new topic in a forum.

### Posts

- `GET /api/topics/{topic_id}/posts`: List all posts in a topic.
- `POST /api/topics/{topic_id}/posts`: Create a new post in a topic.

More endpoints and detailed API documentation are available via the Swagger UI.

## Roadmap

- Implement notifications for users.
- Add support for user statistics and leaderboards.
- Expand moderation capabilities.
- Enhance search and filter functionality.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Open a pull request.

## License

This project is licensed under the GNU License. See the `LICENSE` file for details.

## Contact

For questions or suggestions, feel free to open an issue or contact me at `gabrielramos.email@gmail.com`.