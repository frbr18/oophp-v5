<form method="post">
    <fieldset>
    <legend>Create</legend>

    <p>
        <label>Title:<br> 
        <input type="text" name="contentTitle" value=""/>
        </label>
    </p>

    <p>
        <label>Path:<br> 
        <input type="text" name="contentPath" value=""/>
    </p>

    <p>
        <label>Slug:<br> 
        <input type="text" name="contentSlug" value=""/>
    </p>

    <p>
        <label>Text:<br> 
        <textarea name="contentData"></textarea>
     </p>

     <p>
         <label>Type:<br> 
         <select name="contentType">
            <option value="page">Page</option>
            <option value="post">Post</option>
         </select>
     </p>

     <p>
         <label>Filter:<br> 
         <input type="text" name="contentFilter" value=""/>
     </p>

    <p>
        <button type="submit" name="doCreate">Create</button>
    </p>
    </fieldset>
</form>
