<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/views/assets/logo/logo.png" alt="Logo"></a>
        <span class="exercise-label">New exercise</span>
    </section>
</header>
<main class="container">
    <title>ExerciseLooper</title>
    <h1>New Exercise</h1>
    <form action="/?action=create-exercise" accept-charset="UTF-8" method="post">
        <div class="field">
            <label for="exercise_title">Title</label>
            <input type="text" name="title" id="exercise_title">
        </div>
        <div class="actions">
            <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise">
        </div>
    </form>
</main>