<?php

namespace src\services;

use Exception;
use src\database\models\User;
use src\repositories\UserRepository;
use src\requests\users\StoreRequest;
use src\requests\users\UpdateRequest;

class UserService
{
    protected UserRepository $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /**
     * Saves a new user.
     *
     * @param StoreRequest $request The request containing the user data.
     *
     * @return ?User The saved user instance, or null if an error occurred.
     *
     * @throws Exception If an error occurs while saving the user.
     */
    function save(StoreRequest $request): ?User
    {
        try {
            $executed = $this->userRepository->setModel((new User)->set($request->get()))->save();
            notification("Os dados foram salvos com sucesso", MESSAGE_SUCCESS);
            return $executed;
        } catch (Exception $e) {
            notification("Não foi possível salvar os dados", MESSAGE_ERROR);
            return null;
        }
    }


    /**
     * Updates an existing user.
     *
     * @param UpdateRequest $request The request containing the user data.
     *
     * @return ?User The updated user instance, or null if an error occurred.
     *
     * @throws Exception If an error occurs while updating the user.
     */
    function update(UpdateRequest $request): ?User
    {
        try {
            $executed = $this->userRepository->setModel((new User)->set($request->get()))->update();
            notification("Os dados foram salvos com sucesso", MESSAGE_SUCCESS);
            return $executed;
        } catch (Exception $e) {
            notification("Não foi possível salvar os dados", MESSAGE_ERROR);
            return null;
        }
    }

    /**
     * Retrieves users using pagination.
     *
     * @return ?array An array containing the users' results and their pagination, or null if an error occurs.
     * @throws Exception If an error occurs while retrieving the users.
     */
    function getUsingPages(): ?array
    {
        try {
            $response = $this->userRepository->allWithPaginate();
            return [$response->results, $response->paginate];
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Finds a user by their ID.
     *
     * @param string $id The unique identifier of the user.
     *
     * @return User|null The user instance with the given ID, or null if the user does not exist.
     *
     * @throws Exception If an error occurs while retrieving the user.
     */
    function find(string $id): ?User
    {
        try {
            return $this->userRepository->byId($id);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Deletes a user by their ID.
     *
     * @param string $id The unique identifier of the user.
     *
     * @return ?bool True if the user is successfully deleted, null if an error occurs, or false if the user does not exist.
     *
     * @throws Exception If an error occurs while deleting the user.
     */
    function delete(string $id): ?bool
    {
        try {
            notification("O usuário foi excluído com sucesso", MESSAGE_SUCCESS);
            return $this->userRepository->setModel((new User)->set(["id" => $id]))->destroy();
        } catch (Exception $e) {
            notification("Não foi possível excluir o usuário", MESSAGE_ERROR);
            return null;
        }
    }
}
