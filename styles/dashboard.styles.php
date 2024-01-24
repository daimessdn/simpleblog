<style>
    .form-group {
        display: flex;
        flex-direction: column;

        max-width: 100%;
        margin-bottom: 1rem;
    }

    .form-group label {
        margin-bottom: .5rem;
    }

    .form-group input, .form-group textarea {
        padding: .5rem;

        border-radius: none;
        border: 1px solid #000000;

        font-family: "Helvetica Neue", sans-serif;
        font-size: 12pt;
    }

    .btn {
        padding: .5rem 1rem;
        font-family: "Helvetica Neue", sans-serif;

        background-color: #000000;
        color: #F6F7EB;

        border-radius: none;
        border: none;
        outline: none;

        cursor: pointer;

        font-size: 11pt;
    }

    table {
        margin-top: 1rem;
        border-collapse: collapse;
        width: 100%;

        text-align: left;
    }

    table thead tr:first-child {
        background-color: #902923;
        color: #F6F7EB;
    }

    table tbody tr:nth-child(even) {
        background-color: #902923;
        color: #F6F7EB;
    }

    table tbody tr:nth-child(odd) {
        background-color: #F6F7EB;
    }

    table thead tr {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    table tr th, table tr td {
        padding: .5rem;
    }

    table tr th:first-child, table tr td:first-child {
        width: 1rem;
    }
</style>