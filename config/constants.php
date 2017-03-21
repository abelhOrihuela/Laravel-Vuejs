<?php

class Constants
{
  const MIN_VALUE = 0.0;
  const MAX_VALUE = 1.0;


  const TYPE_USER_ADMIN = 1;
  const TYPE_USER_CUSTOMER = 2;
  const ADMIN = "A";
  const CUSTOMER = "C";

  const NOT_AVAILABE = "No Disponible";

  const SEARCH="SELECT
  candidates.id,
  candidates.user_id,
  candidates.username,
  candidates.url,
  candidates.gender,
  candidates.email,
  candidates.location,
  candidates.day,
  candidates.month,
  candidates.year,
  candidates.code,
  candidates.phone,
  candidates.position,
  candidates.category,
  candidates.subcategory,
  candidates.created_at,
  candidates.updated_at,
  photos.name_photo,
  category.name as name_category,
  subcategories.name as name_subactegory
  FROM photos, candidates, category, subcategories
  WHERE photos.candidate_id=candidates.id
  AND candidates.category=category.id
  AND candidates.subcategory=subcategories.id";


  const SEARCH_ECONOMIC="SELECT
  candidates.id,
  candidates.user_id,
  candidates.username,
  candidates.url,
  candidates.gender,
  candidates.email,
  candidates.location,
  candidates.day,
  candidates.month,
  candidates.year,
  candidates.code,
  candidates.phone,
  candidates.position,
  candidates.category,
  candidates.subcategory,
  candidates.created_at,
  candidates.updated_at,
  photos.name_photo,
  category.name as name_category,
  subcategories.name as name_subactegory
  FROM photos, candidates, category, subcategories, candidateeconomic
  WHERE photos.candidate_id=candidates.id
  AND candidates.category=category.id
  AND candidates.subcategory=subcategories.id
  AND candidateeconomic.candidate_id=candidates.id";

}


 ?>
