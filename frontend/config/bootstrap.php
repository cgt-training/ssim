<?php
//alias for images path in frontend
Yii::setAlias('@imagepath', Yii::$app->request->baseUrl.('../frontend/web/images'));

//alias for profile image
Yii::setAlias('@user_profile_photo_path', Yii::$app->request->baseUrl.('../frontend/web/images/user'));

//alias for company logo
Yii::setAlias('@company_logo_path', Yii::$app->request->baseUrl.('../frontend/web/images/company_logo'));

//alias for js path in frontend
Yii::setAlias('@jspath', Yii::$app->request->baseUrl.('ssim/js'));