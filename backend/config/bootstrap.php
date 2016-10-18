<?php
//alias for images path in backend
Yii::setAlias('@imagepath', Yii::$app->request->baseUrl.('../backend/web/images'));

//alias for profile image
Yii::setAlias('@user_profile_photo_path', Yii::$app->request->baseUrl.('../../backend/web/uploads/user'));

//alias for js path in frontend
Yii::setAlias('@jspath_admin', Yii::$app->request->baseUrl.('ssim/admin/js'));