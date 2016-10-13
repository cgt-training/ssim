<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createCompany" permission
        $createCompany = $auth->createPermission('createCompany');
        $createCompany->description = 'Create a Company';
        $auth->add($createCompany);
        
         // add "createDepartment" permission
        $createDepartment = $auth->createPermission('createDepartment');
        $createDepartment->description = 'Create a Department';
        $auth->add($createDepartment);

        // add "createBranch" permission
        $createBranch = $auth->createPermission('createBranch');
        $createBranch->description = 'Create a Branch';
        $auth->add($createBranch);

        // add "updateCompany" permission
        $updateCompany = $auth->createPermission('updateCompany');
        $updateCompany->description = 'Update company';
        $auth->add($updateCompany);
        
         // add "updateDepartment" permission
        $updateDepartment = $auth->createPermission('update  Department');
        $updateDepartment->description = 'Update Department';
        $auth->add($updateDepartment);

        // add "updateBranch" permission
        $updateBranch = $auth->createPermission('updateBranch');
        $updateBranch->description = 'Update Branch';
        $auth->add($updateBranch);

        // add "deleteCompany" permission
        $deleteCompany = $auth->createPermission('deleteCompany');
        $deleteCompany->description = 'Delete Company';
        $auth->add($deleteCompany);

        // add "deleteDepartment" permission
        $deleteDepartment = $auth->createPermission('deleteDepartment');
        $deleteDepartment->description = 'Delete Department';
        $auth->add($deleteDepartment);

        // add "deleteBranch" permission
        $deleteBranch = $auth->createPermission('deleteBranch');
        $deleteBranch->description = 'Delete Branch';
        $auth->add($deleteBranch);

        // add "author" role and give this role the "create" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createCompany);
        $auth->addChild($author, $createDepartment);
        $auth->addChild($author, $createBranch);

         // add "updator" role and give this role the "update" permission
        $updator = $auth->createRole('updator');
        $auth->add($updator);
        $auth->addChild($updator, $updateCompany);
        $auth->addChild($updator, $updateDepartment);
        $auth->addChild($updator, $updateBranch);

         // add "deleter" role and give this role the "delete" permission
        $deleter = $auth->createRole('deleter');
        $auth->add($deleter);
        $auth->addChild($deleter, $deleteCompany);
        $auth->addChild($deleter, $deleteDepartment);
        $auth->addChild($deleter, $deleteBranch);

        // add "admin" role and give this role all the permissions
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $updator);
        $auth->addChild($admin,$deleter);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        // $auth->assign($author, 2);
        // $auth->assign($admin, 1);
    }
}