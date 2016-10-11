<?php
//alias for images path in frontend
Yii::setAlias('@imagepath', Yii::$app->request->baseUrl.('../frontend/web/images'));

//alias for profile image
Yii::setAlias('@user_profile_photo_path', Yii::$app->request->baseUrl.('../frontend/web/uploads/user'));

//alias for company logo
Yii::setAlias('@company_logo_path', Yii::$app->request->baseUrl.('../frontend/web/uploads/company_logo'));