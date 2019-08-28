<form method="get">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Title (use % as wildcard):
            <input type="text" name="searchTitle" value="<?= esc($searchTitle) ?>">
        </label>
        
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>
