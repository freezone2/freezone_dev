<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CCabinetPage extends CBitrixComponent
{
    public function executeComponent()
    {
        if (!CUser::IsAdmin()) {
            header('Location: /');
            exit;
        }
        $this->includeComponentTemplate();
    }
}