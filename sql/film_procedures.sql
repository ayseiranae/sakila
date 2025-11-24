-- Stored Procedures untuk Film

DELIMITER $$

-- Get all films
CREATE PROCEDURE GetAllFilms()
BEGIN
    SELECT * FROM film ORDER BY title;
END$$

-- Get film by ID
CREATE PROCEDURE GetFilmById(IN p_film_id SMALLINT)
BEGIN
    SELECT * FROM film WHERE film_id = p_film_id;
END$$

-- Insert new film
CREATE PROCEDURE InsertFilm(
    IN p_title VARCHAR(255),
    IN p_description TEXT,
    IN p_release_year YEAR,
    IN p_language_id TINYINT,
    IN p_rental_duration TINYINT,
    IN p_rental_rate DECIMAL(4,2),
    IN p_length SMALLINT,
    IN p_replacement_cost DECIMAL(5,2),
    IN p_rating ENUM('G','PG','PG-13','R','NC-17')
)
BEGIN
    INSERT INTO film (title, description, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, rating, last_update)
    VALUES (p_title, p_description, p_release_year, p_language_id, p_rental_duration, p_rental_rate, p_length, p_replacement_cost, p_rating, NOW());
END$$

-- Update film
CREATE PROCEDURE UpdateFilm(
    IN p_film_id SMALLINT,
    IN p_title VARCHAR(255),
    IN p_description TEXT,
    IN p_release_year YEAR,
    IN p_language_id TINYINT,
    IN p_rental_duration TINYINT,
    IN p_rental_rate DECIMAL(4,2),
    IN p_length SMALLINT,
    IN p_replacement_cost DECIMAL(5,2),
    IN p_rating ENUM('G','PG','PG-13','R','NC-17')
)
BEGIN
    UPDATE film SET 
        title = p_title,
        description = p_description,
        release_year = p_release_year,
        language_id = p_language_id,
        rental_duration = p_rental_duration,
        rental_rate = p_rental_rate,
        length = p_length,
        replacement_cost = p_replacement_cost,
        rating = p_rating,
        last_update = NOW()
    WHERE film_id = p_film_id;
END$$

-- Delete film
CREATE PROCEDURE DeleteFilm(IN p_film_id SMALLINT)
BEGIN
    DELETE FROM film WHERE film_id = p_film_id;
END$$

DELIMITER ;

