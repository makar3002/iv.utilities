# Набор стартовых утилит для разработки приложения.

### Содержит реализации наиболее часто реализуемых классов, описание которых просто отнимает время.

Q: Как использовать класс подключения?

A: Реализовать интерфейс Connection\ConnectionConfiguration, создать объект и передать его в 
MysqliConnection::connect().

Q: Не хочу, чтобы нужно было называть папки и файлы в нижнем регистре, что делать?

A: Убрать вторую строку в Utility\Loader::load().

