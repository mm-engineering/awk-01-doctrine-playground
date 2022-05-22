# As We Know, Episode 01

**I Want To Speak To The EntityManager**

_Doctrine EntityManager Tips And Tricks_

This basic Symfony-based project is the playground for exploring various ways of interacting with [Doctrine](https://symfony.com/doc/current/doctrine.html)’s [`EntityManager`](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/getting-started.html#obtaining-the-entitymanager).

## Prerequisites

1. Docker (e.g., Docker Desktop), accessible from a shell (e.g., `bash`).

We will run everything in containers, so there is no need to install anything else.
To run `composer` from an official public container, we will use a handy shell alias:

```shell
alias dcomposer='docker run --rm --interactive --tty --volume $PWD:/app composer'
```

## Workshop Steps

### Install Playground

1. Clone this repository.
2. Run `dcomposer install` to pull all dependencies.
3. Run `docker-compose build --no-cache --pull` to assemble the containers from scratch.
4. Run `docker-compose up -d` to launch the containers in the background.
