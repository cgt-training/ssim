<?php
//alias for images path in backend
Yii::setAlias('@imagepath', Yii::$app->request->baseUrl.('../backend/web/images'));

//alias for profile image
Yii::setAlias('@user_profile_photo_path', Yii::$app->request->baseUrl.('../../backend/web/uploads/user'));

//alias for company logo
Yii::setAlias('@company_logo_path', Yii::$app->request->baseUrl.('../../backend/web/uploads/company_logo'));

//alias for js path in backend
Yii::setAlias('@jspath', Yii::$app->request->baseUrl.'ssim/admin/js');
