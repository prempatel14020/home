document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("projectsContainer");

    fetch("../js/projects.json")
        .then((response) => response.json())
        .then((projects) => {
            if (!projects.length) {
                container.innerHTML =
                    "<p class='text-orange-500 text-center w-full'>No projects found.</p>";
                return;
            }

            projects.forEach((project) => {
                const card = document.createElement("div");
                card.className =
                    "bg-[var(--card)] p-8 rounded-2xl shadow-md rounded-lg shadow-lg p-6 flex flex-col hover:scale-105 transition-transform duration-300";

                card.innerHTML = `
          <h5 class="text-xl font-semibold text-orange-400 mb-2">${project.name}</h5>
          <p class="text-orange-500 text-sm mb-4">Uploaded: ${project.date}</p>
          <p class="text-orange-500 flex-1 mb-4">${project.description || ""}</p>
          <a href="${project.url}" target="_blank" class="mt-auto inline-block text-center px-4 py-2 border border-orange-600 rounded hover:bg-orange-600 hover:text-black transition-colors">
            View Project
          </a>
        `;

                container.appendChild(card);
            });
        })
        .catch((error) => {
            console.error("Error loading projects:", error);
            container.innerHTML =
                "<p class='text-red-500 text-center w-full'>Failed to load projects.</p>";
        });
});
