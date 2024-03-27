<?php

namespace src\controllers;

use src\core\Redirect;
use src\core\View;
use src\requests\users\StoreRequest;
use src\requests\users\UpdateRequest;
use src\services\UserService;

class UserController extends Controller
{

    /**
     * Get users using pagination and displays on list
     * @return View
     */
    function index(): View
    {
        [$users, $paginate] = (new UserService)->getUsingPages();
        return View::render("app.users.index", ["users" => $users, "paginate" => $paginate]);
    }
    /**
     * Displays the form to create a new user
     *
     * @return View
     */
    function create(): View
    {
        return View::render("app.users.create", []);
    }


    /**
     * Stores a new user in the database.
     *
     * @param StoreRequest $request The request object containing the user data.
     *
     * @return Redirect A redirect object to redirect the user to the users list page.
     */
    function store(StoreRequest $request): Redirect
    {
        (new UserService)->save($request);
        return Redirect::to("/users");
    }


    /**
     * Displays the form to edit a specific user.
     *
     * @param string $id The unique identifier of the user to be edited.
     *
     * @return View A view object containing the form to edit the user.
     */
    function edit(string $id): View
    {
        $user = (new UserService)->find($id);
        return View::render("app.users.edit", [
            "user" => $user
        ]);
    }


    /**
     * Updates a specific user in the database.
     *
     * @param UpdateRequest $request The request object containing the user data.
     *
     * @return Redirect A redirect object to redirect the user to the users list page.
     */
    function update(UpdateRequest $request): Redirect
    {
        (new UserService)->update($request);
        return Redirect::to("/users");
    }


    /**
     * Deletes a specific user from the database.
     *
     * @param string $id The unique identifier of the user to be deleted.
     *
     * @return Redirect A redirect object to redirect the user to the users list page.
     */
    function delete(string $id): Redirect
    {
        (new UserService)->delete($id);
        return Redirect::to("/users");
    }
}
