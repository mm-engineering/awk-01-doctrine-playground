# As We Know, Episode 01: I Want To Speak To The EntityManager

_Doctrine EntityManager Tips And Tricks_

This basic Symfony-based project is the playground for exploring various ways of interacting with [Doctrine](https://symfony.com/doc/current/doctrine.html)’s [`EntityManager`](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/getting-started.html#obtaining-the-entitymanager).

## Prerequisites

1. Docker (e.g., Docker Desktop), accessible from a shell (e.g., `bash`).

We will run everything in containers, so there is no need to install anything else.

## Workshop Steps

### Install Playground

1. Clone this repository, e.g., `git clone https://github.com/mm-engineering/awk-01-doctrine-playground.git workshop`.
2. Go into the cloned directory, e.g., `cd workshop`.
3. Run `docker run --rm --interactive --tty --volume $PWD:/app composer install` to pull all dependencies.
4. Run `docker-compose build --no-cache --pull` to assemble the containers from scratch.
5. Run `docker-compose up -d` to launch the containers in the background.

### Exercise 1: Create Doctrine entity classes

Let’s create a handy shell alias for the following section:

```shell
# Execute bin/console in docker-compose service named 'php' in current directory
alias dconsole='docker-compose exec php bin/console'
```

1. Create a couple of entities:
   1. Run `dconsole make:entity`. Name it `Warehouse`. No fields for now.
   2. Run `dconsole make:entity`. Name it `Item`. No fields for now.
2. Modify them and create a relationship:
   1. Run `dconsole make:entity`. Use the name `Warehouse` again to modify it:
      1. Add field `name`. Type `string`. Length `64`. Not nullable.
      2. Add field `items`. Type `OneToMany`. Related to class `Item`. Inverse field named `warehouse`, not nullable, orphan removal enabled.
   2. Run `dconsole make:entity`. Use the name `Item` again to modify it:
      1. Add field `name`. Type `string`. Length `255`. Not nullable.
      2. Add field `price`. Type `integer`. Nullable.
3. Generate an appropriate migration with `dconsole make:migration`.
4. Apply said migration with `dconsole doctrine:migration:migrate`.
5. Commit all changes.

Review points:

- Check out the code generated by the Symfony [Maker bundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html).
- Also, feel free to connect to the PostgreSQL instance at `localhost:50443/app` and check out the tables that were automatically created.

### Exercise 2: Inject EntityManager

In the following exercises we will be modifying the file `src/Command/WorkshopCommand.php`, and then executing the corresponding Symfony command.

1. To retrieve the Doctrine `EntityManager`, we will use Symfony dependency injection. There are at least two interfaces that can be injected for that purpose:
   1. `\Doctrine\ORM\EntityManagerInterface`. This is the most direct way.
   2. `\Doctrine\Persistence\ManagerRegistry $doctrine`. This way, we get the entity manager by calling `ManagerRegistry::getManager`.
2. Run `dconsole workshop` just to make sure it executes without errors.
3. Commit all changes.

Review points:

- Retrieving the entity manager through the manager registry is required when multiple entity managers exist.
- More importantly, through the manager registry we could cure the `ORMException` that tells us that `The EntityManager is closed.`. To learn more, check out the method `ManagerRegistry::resetManager`.

### Exercise 3: Enable SQL logging

1. Run `dcomposer require --dev debug`.
2. Modify the file `config/packages/monolog.yaml`. Add the following block to the section `when@dev.monolog.handlers`:
   ```yaml
               doctrine:
                   type: stream
                   path: php://stderr
                   level: debug
                   channels: ["doctrine"]
   ```
