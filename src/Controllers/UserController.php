<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;
use Framework\Components\Request;

class UserController extends BaseController
{
    public $user;
    public $request;

    /**
     * UserController constructor.
     */

    public function __construct()
    {
        $this->user = new User();
        $this->request = new Request();
    }

    /**
     * @return array
     * Method get all record and return array record
     *
     */

    public function listUser ()
    {

        $recordInPage = 5;  // number record in page
        $total = count($this->user->all());  // total category query from database
        $numberPage = ceil($total / $recordInPage);  // number page
        $start = $this->getNumberHandling() * $recordInPage;  // at the start'th position in database

        //get request current page
        $users = $this->user->GetLimit($start, $recordInPage);

        $page = $this->request->getRequestGet("page") ?? 1;
        $action = $this->request->getRequestGet("action");
        $data = [
            "users" => $users,
            "numberPage" => $numberPage,
            "page" => $page,
            "action" => $action,

        ];
        $this->render('User/listUser', 'data', $data);
    }

    /**
     * Method show form create
     */
    public function create()
    {
        $this->render("User/addUser");
    }

    /***
     *
     * Method create a record and navigate to listProduct
     */

    public function store()
    {

        $request = $this->request->getRequestPost();
        $name = $request['name'];
        $email = $request['email'];
        $status = $request['status'];
        $result = $this->user->create($request);
        header("Location:index.php?controllers=User&&action=listUser");
    }

    /**
     * Method navigate to editProduct with id =$id
     *
     */
    public function showUpdate()
    {

        $id = $this->request->getRequestGet('id');

        $result = $this->user->find($id)->get();

        $this->render('User/editUser', 'result', $result);
    }

    /**
     *Methord search all data with values search =$search_name
     * return list page with  all record comfort with requirement
     */
    public function update()
    {
        $request = $this->request->getRequestPost();
        $id = $request['id'];
        $result = $this->user->update($request, $id);
        header("Location:index.php?controllers=User&&action=listUser");

    }

    /**
     *Method detroy record with id =$id
     */

    public function delete()
    {

        $id = $this->request->getRequestGet('id');
        $result = $this->user->delete($id);
        header("Location:index.php?controllers=User&&action=listUser");
    }

    /**
     * @param $filename
     * @return bool
     */
    public function deleteByCondition()
    {
//        $result = true;
        $listId = $this->request->getRequestPost()['listId'];
        $this->user->destroy('id', $listId);

        echo json_encode($listId);
        die();

    }

    /**
     *  Method active column checked with arr[id] =$listId
     */

    public function active()
    {
        $status = 1;
        $listId = $this->request->getRequestPost()['listId'];
        $active = $this->request->getRequestPost()['active'];
        if ($active == 'false') {
            $status = 0;
        }
        foreach ($listId as $value) {
            $this->user->update(['status' => $status], $value);
        }
        $users = $this->user->all();
        $this->render("User/list-render", 'users', $users);

    }

    /**
     * Method sort order by  each column
     *
     */

    public function sort()
    {
        $typeSort = $this->request->getRequestGet()['typeSort'];
        $sort = $this->request->getRequestGet()['sort'];

        $users = $this->user->getAllOrderBy($typeSort, $sort)->getarr();
//        var_dump($users);
        $this->render("User/list-render", 'users', $users);

    }

    /**
     *Method search by name =$search_name
     */

    public function search()
    {
        $name = $this->request->getRequestPost('search_name');
        $list = $this->user->search($name);
        $this->render('User/listUser', 'list', $list);
    }

    protected function getNumberHandling()
    {
        return isset($_GET["page"]) && $_GET["page"] >= 1 ? ($_GET["page"] - 1) : 0;
    }

}