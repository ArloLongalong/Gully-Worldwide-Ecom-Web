#!/bin/bash

case "$1" in
    "start")
        echo "Starting Gully Web Shop..."
        docker-compose up -d
        echo "Application is running at http://localhost:8080"
        echo "phpMyAdmin is available at http://localhost:8081"
        ;;
    "stop")
        echo "Stopping Gully Web Shop..."
        docker-compose down
        ;;
    "restart")
        echo "Restarting Gully Web Shop..."
        docker-compose restart
        ;;
    "logs")
        docker-compose logs -f
        ;;
    "rebuild")
        echo "Rebuilding containers..."
        docker-compose down
        docker-compose up -d --build
        ;;
    "shell")
        echo "Opening shell in web container..."
        docker-compose exec web bash
        ;;
    "db-shell")
        echo "Opening MySQL shell..."
        docker-compose exec db mysql -u root -pgully_password gullydb
        ;;
    "status")
        echo "Container status:"
        docker-compose ps
        ;;
    "clean")
        echo "Cleaning up containers and volumes..."
        docker-compose down -v
        docker system prune -f
        ;;
    *)
        echo "Usage: $0 {start|stop|restart|logs|rebuild|shell|db-shell|status|clean}"
        echo ""
        echo "Commands:"
        echo "  start     - Start the application"
        echo "  stop      - Stop the application"
        echo "  restart   - Restart the application"
        echo "  logs      - View application logs"
        echo "  rebuild   - Rebuild containers"
        echo "  shell     - Open shell in web container"
        echo "  db-shell  - Open MySQL shell"
        echo "  status    - Show container status"
        echo "  clean     - Clean up containers and volumes"
        exit 1
        ;;
esac 