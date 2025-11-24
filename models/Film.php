<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $film_id
 * @property string $title
 * @property string|null $description
 * @property string|null $release_year
 * @property int $language_id
 * @property int|null $original_language_id
 * @property int $rental_duration
 * @property float $rental_rate
 * @property int|null $length
 * @property float $replacement_cost
 * @property string|null $rating
 * @property string|null $special_features
 * @property string $last_update
 *
 * @property Actor[] $actors
 * @property Category[] $categories
 * @property FilmActor[] $filmActors
 * @property FilmCategory[] $filmCategories
 * @property Inventory[] $inventories
 * @property Language $language
 * @property Language $originalLanguage
 */
class Film extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const RATING_G = 'G';
    const RATING_PG = 'PG';
    const RATING_PG_13 = 'PG-13';
    const RATING_R = 'R';
    const RATING_NC_17 = 'NC-17';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'release_year', 'original_language_id', 'length', 'special_features'], 'default', 'value' => null],
            [['rental_duration'], 'default', 'value' => 3],
            [['rental_rate'], 'default', 'value' => 4.99],
            [['replacement_cost'], 'default', 'value' => 19.99],
            [['rating'], 'default', 'value' => 'G'],
            [['title', 'language_id'], 'required'],
            [['description', 'rating', 'special_features'], 'string'],
            [['release_year', 'last_update'], 'safe'],
            [['language_id', 'original_language_id', 'rental_duration', 'length'], 'integer'],
            [['rental_rate', 'replacement_cost'], 'number'],
            [['title'], 'string', 'max' => 128],
            ['rating', 'in', 'range' => array_keys(self::optsRating())],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'language_id']],
            [['original_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['original_language_id' => 'language_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'title' => 'Title',
            'description' => 'Description',
            'release_year' => 'Release Year',
            'language_id' => 'Language ID',
            'original_language_id' => 'Original Language ID',
            'rental_duration' => 'Rental Duration',
            'rental_rate' => 'Rental Rate',
            'length' => 'Length',
            'replacement_cost' => 'Replacement Cost',
            'rating' => 'Rating',
            'special_features' => 'Special Features',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Actors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActors()
    {
        return $this->hasMany(Actor::class, ['actor_id' => 'actor_id'])->viaTable('film_actor', ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['category_id' => 'category_id'])->viaTable('film_category', ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[FilmActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[FilmCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCategories()
    {
        return $this->hasMany(FilmCategory::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Inventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['language_id' => 'language_id']);
    }

    /**
     * Gets query for [[OriginalLanguage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginalLanguage()
    {
        return $this->hasOne(Language::class, ['language_id' => 'original_language_id']);
    }


    /**
     * column rating ENUM value labels
     * @return string[]
     */
    public static function optsRating()
    {
        return [
            self::RATING_G => 'G',
            self::RATING_PG => 'PG',
            self::RATING_PG_13 => 'PG-13',
            self::RATING_R => 'R',
            self::RATING_NC_17 => 'NC-17',
        ];
    }

    /**
     * @return string
     */
    public function displayRating()
    {
        return self::optsRating()[$this->rating];
    }

    /**
     * @return bool
     */
    public function isRatingG()
    {
        return $this->rating === self::RATING_G;
    }

    public function setRatingToG()
    {
        $this->rating = self::RATING_G;
    }

    /**
     * @return bool
     */
    public function isRatingPg()
    {
        return $this->rating === self::RATING_PG;
    }

    public function setRatingToPg()
    {
        $this->rating = self::RATING_PG;
    }

    /**
     * @return bool
     */
    public function isRatingPg13()
    {
        return $this->rating === self::RATING_PG_13;
    }

    public function setRatingToPg13()
    {
        $this->rating = self::RATING_PG_13;
    }

    /**
     * @return bool
     */
    public function isRatingR()
    {
        return $this->rating === self::RATING_R;
    }

    public function setRatingToR()
    {
        $this->rating = self::RATING_R;
    }

    /**
     * @return bool
     */
    public function isRatingNc17()
    {
        return $this->rating === self::RATING_NC_17;
    }

    public function setRatingToNc17()
    {
        $this->rating = self::RATING_NC_17;
    }

    // Stored Procedure Methods
    public static function getAllFilmsFromSP()
    {
        return Yii::$app->db->createCommand('CALL GetAllFilms()')->queryAll();
    }

    public static function getFilmByIdFromSP($id)
    {
        return Yii::$app->db->createCommand('CALL GetFilmById(:id)', [':id' => $id])->queryOne();
    }

    public function insertFilmWithSP()
    {
        return Yii::$app->db->createCommand('CALL InsertFilm(:title, :description, :release_year, :language_id, :rental_duration, :rental_rate, :length, :replacement_cost, :rating)', [
            ':title' => $this->title,
            ':description' => $this->description,
            ':release_year' => $this->release_year,
            ':language_id' => $this->language_id,
            ':rental_duration' => $this->rental_duration,
            ':rental_rate' => $this->rental_rate,
            ':length' => $this->length,
            ':replacement_cost' => $this->replacement_cost,
            ':rating' => $this->rating
        ])->execute();
    }

    public function updateFilmWithSP()
    {
        return Yii::$app->db->createCommand('CALL UpdateFilm(:film_id, :title, :description, :release_year, :language_id, :rental_duration, :rental_rate, :length, :replacement_cost, :rating)', [
            ':film_id' => $this->film_id,
            ':title' => $this->title,
            ':description' => $this->description,
            ':release_year' => $this->release_year,
            ':language_id' => $this->language_id,
            ':rental_duration' => $this->rental_duration,
            ':rental_rate' => $this->rental_rate,
            ':length' => $this->length,
            ':replacement_cost' => $this->replacement_cost,
            ':rating' => $this->rating
        ])->execute();
    }

    public static function deleteFilmWithSP($id)
    {
        return Yii::$app->db->createCommand('CALL DeleteFilm(:id)', [':id' => $id])->execute();
    }
}
